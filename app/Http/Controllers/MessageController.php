<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\User;
use App\Models\Recipient;
use App\Models\Conversation;
use Illuminate\Http\Request;
use App\Events\MessageCreated;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Validation\Rule;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $user = Auth::user();
        $conversation = $user->conversations()
            ->with(['participants' => function ($builder) use ($user) {
                $builder->where('id', '<>', $user->id);
            }])->findOrFail($id);

        $messages = $conversation->messages()
            ->with('user')
            ->where(function ($query) use ($user) {
                $query->where('user_id', $user->id)
                    ->orWhereRaw('id IN (
                SELECT message_id FROM recipients
                WHERE recipients.message_id = messages.id
                AND recipients.user_id = ?
                 AND recipients.deleted_at IS NULL
            )', [$user->id]);
            })
            ->paginate();
        return [
            'conversation' => $conversation,
            'messages' => $messages
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'message' => ['required', 'string'],
            'coversation_id' => [
                'required_without:user_id',
                'int', 'exists:conversations,id'
            ],
            'user_id' => [
                'required_without:coversation_id',
                'int', 'exists:users,id'
            ],
        ]);

        $user = Auth::user();
        $coversation_id = $request->coversation_id;
        $user_id = $request->user_id;

        DB::beginTransaction();
        try {
            if ($coversation_id) {
                $conversation = $user->conversations()->findOrFail($coversation_id);
            } else {
                $conversation = Conversation::where('type', 'peer')->whereHas('participants', function ($builder) use ($user_id, $user) {
                    $builder->join('participants as participants2', 'participants2.conversation_id', 'participants.conversation_id')
                        ->where('participants.conversation_id', $user_id)
                        ->where('participants2.conversation_id', $user->id);
                })->first();

                if (!$conversation) {
                    $conversation = Conversation::create([
                        'user_id' => $user->id,
                        'type' => 'peer',
                    ]);

                    $conversation->participants()->attach([
                        $user->id => ['joined_at' => now()],
                        $user_id => ['joined_at' => now()]
                    ]);
                }
            }

            $message = $conversation->messages()->create([
                'user_id' => $user->id,
                'body' => $request->message,
            ]);

            DB::statement('
                INSERT INTO recipients (user_id , message_id)
                SELECT user_id , ?  FROM participants
                WHERE conversation_id = ?
                AND user_id <> ?
            ', [$message->id, $conversation->id, $user->id]);

            $conversation->update([
                'last_message_id' => $message->id,
            ]);

            DB::commit();
            $message->load('user');
            broadcast(new MessageCreated($message));
        } catch (Throwable $e) {
            DB::rollBack();

            throw $e;
        }

        return $message;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Recipient::where([
            'user_id' => Auth::id(),
            'message_id' => $id
        ])->delete();

        return [
            'message' => 'deleted',
        ];
    }
}
