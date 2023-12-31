<?php

use App\Http\Controllers\ConversationController;
use App\Http\Controllers\MessageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function(){

    Route::get('conversations',[ConversationController::class,'index']);
    Route::get('conversations/{conversation}',[ConversationController::class,'show']);
    Route::post('conversations/{conversation}/participants',[ConversationController::class,'addParticipant']);
    Route::delete('conversations/{conversation}/participants',[ConversationController::class,'removeParticipant']);

    Route::put('conversations/{conversation}/read',[ConversationController::class,'markAsRead']);

    Route::get('conversations/{id}/messages',[MessageController::class,'index']);
    Route::post('messages',[MessageController::class,'store'])->name('api.messages.sotre');
    Route::delete('messages/{id}',[MessageController::class,'destroy']);
});
