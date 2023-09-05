
<!DOCTYPE html>
<html lang="en">
    <!-- Head -->
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1, shrink-to-fit=no, viewport-fit=cover">
        <title>Messenger - 2.0.1</title>

        <!-- Favicon -->
        <link rel="shortcut icon" href="" type="image/x-icon">

        <!-- Font -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
    	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700" rel="stylesheet">

        <!-- Template CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/template.bundle.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/template.dark.bundle.css') }}" media="(prefers-color-scheme: dark)">
    </head>

    <body>
        <div id="chat-app">
        <!-- Layout -->
        <div class="layout overflow-hidden">
            <!-- Navigation -->
            <nav class="navigation d-flex flex-column text-center navbar navbar-light hide-scrollbar">
                <!-- Brand -->
                <a href="index.html" title="Messenger" class="d-none d-xl-block mb-6">
                    <svg version="1.1" width="46px" height="46px" fill="currentColor" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 46 46" enable-background="new 0 0 46 46" xml:space="preserve">
                        <polygon opacity="0.7" points="45,11 36,11 35.5,1 "/>
                        <polygon points="35.5,1 25.4,14.1 39,21 "/>
                        <polygon opacity="0.4" points="17,9.8 39,21 17,26 "/>
                        <polygon opacity="0.7" points="2,12 17,26 17,9.8 "/>
                        <polygon opacity="0.7" points="17,26 39,21 28,36 "/>
                        <polygon points="28,36 4.5,44 17,26 "/>
                        <polygon points="17,26 1,26 10.8,20.1 "/>
                    </svg>

                </a>

                <!-- Nav items -->
                <ul class="d-flex nav navbar-nav flex-row flex-xl-column flex-grow-1 justify-content-between justify-content-xl-center align-items-center w-100 py-4 py-lg-2 px-lg-3" role="tablist">
                    <!-- Invisible item to center nav vertically -->
                    <li class="nav-item d-none d-xl-block invisible flex-xl-grow-1">
                        <a class="nav-link py-0 py-lg-8" href="#" title="">
                            <div class="icon icon-xl">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                            </div>
                        </a>
                    </li>



                    <!-- Friends -->
                    <li class="nav-item">
                        <a class="nav-link py-0 py-lg-8" id="tab-friends" href="#tab-content-friends" title="Friends" data-bs-toggle="tab" role="tab">
                            <div class="icon icon-xl">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                            </div>
                        </a>
                    </li>

                    <!-- Chats -->
                    <li class="nav-item">
                        <a class="nav-link active py-0 py-lg-8" id="tab-chats" href="#tab-content-chats" title="Chats" data-bs-toggle="tab" role="tab">
                            <div class="icon icon-xl icon-badged">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                                <div class="badge badge-circle bg-primary">
                                    <span>4</span>
                                </div>
                            </div>
                        </a>
                    </li>





                    <!-- Profile -->
                    <li class="nav-item">
                        <a href="#" class="nav-link p-0 mt-lg-2" data-bs-toggle="modal" data-bs-target="#modal-profile">
                            <div class="avatar avatar-online mx-auto d-none d-xl-block">
                                <img class="avatar-img" src="{{ Auth::user()->avatar_url }}" alt="">
                            </div>
                            <div class="avatar avatar-online avatar-xs d-xl-none">
                                <img class="avatar-img" src="" alt="">
                            </div>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Navigation -->

            <!-- Sidebar -->
            <aside class="sidebar bg-light">
                <div class="tab-content h-100" role="tablist">

                    <!-- Friends -->
                    <div class="tab-pane fade h-100" id="tab-content-friends" role="tabpanel">
                        <div class="d-flex flex-column h-100">
                            <div class="hide-scrollbar">
                                <div class="container py-8">

                                    <!-- Title -->
                                    <div class="mb-8">
                                        <h2 class="fw-bold m-0">Friends</h2>
                                    </div>

                                    <!-- Search -->
                                    <div class="mb-6">
                                        <form action="#">
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <div class="icon icon-lg">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                                    </div>
                                                </div>

                                                <input type="text" class="form-control form-control-lg ps-0" placeholder="Search messages or users" aria-label="Search for messages or users...">
                                            </div>
                                        </form>


                                    </div>

                                    <!-- List -->
                                    <div class="card-list">

                                        @php
                                            $last_letter = '';
                                        @endphp
                                        @foreach ($friends as $friend )
                                            @php
                                                $letter = Str::substr($friend->name, 0, 1);
                                            @endphp

                                            @if($letter != $last_letter)
                                                <div class="my-5">
                                                    <small class="text-uppercase text-muted">{{ $letter }}</small>
                                                </div>
                                            @endif
                                            @php
                                                $last_letter = $letter;
                                            @endphp
                                            <!-- Card -->
                                            <div class="card border-0">
                                                <div class="card-body">

                                                    <div class="row align-items-center gx-5">
                                                        <div class="col-auto">
                                                            <a href="#" class="avatar ">

                                                                <img class="avatar-img" src="{{ $friend->avatar_url }}" alt="">


                                                            </a>
                                                        </div>

                                                        <div class="col">
                                                            <h5><a href="#">{{ $friend->name }}</a></h5>
                                                            <p>{{ $friend->last_seen_at }}</p>
                                                        </div>

                                                        <div class="col-auto">
                                                            <!-- Dropdown -->
                                                            <div class="dropdown">
                                                                <a class="icon text-muted" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                                                                </a>

                                                                <ul class="dropdown-menu">
                                                                    <li><a class="dropdown-item" href="#">New message</a></li>
                                                                    <li><a class="dropdown-item" href="#">Edit contact</a>
                                                                    </li>
                                                                    <li>
                                                                        <hr class="dropdown-divider">
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item text-danger" href="#">Block user</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                            <!-- Card -->
                                        @endforeach



                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Chats -->
                    <div class="tab-pane fade h-100 show active" id="tab-content-chats" role="tabpanel">
                        <div class="d-flex flex-column h-100 position-relative">
                            <div class="hide-scrollbar">

                                <Chat-list />

                            </div>
                        </div>
                    </div>

                </div>
            </aside>
            <!-- Sidebar -->

            <messenger :conversation="conversation" />

        </div>
        <!-- Layout -->






        <!-- Scripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" ></script>
        <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
        <script src="{{ asset('assets/js/template.js') }}"></script>
        <script src="{{ asset('assets/js/vendor.js') }}"></script>
        <script src="{{ asset('js/moment.js') }}"></script>
        <script src="{{ asset('js/manifest.js') }}"></script>
        <script src="{{ asset('js/vendor.js') }}"></script>
        <script>

            const userid ="{{  Auth::id() }}";
            const csrf_token = '{{ csrf_token() }}';
            const avatar = '{{ Auth::user()->avatar_url }}';
           const empty= avatar.replace('amp;','');
           const userAvatar= empty.replace(/\s/g, '%20');
            </script>
            <script src="{{ asset('js/messages.js') }}"></script>

        {{-- <script src="{{ asset('assets/js/vendor.js') }}"></script>
        <script>
            // console.log(userid);
            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

            var pusher = new Pusher('31ec05d5d27dc4eb1c5d', {
              cluster: 'ap2',
              authEndpoint : "/broadcasting/auth",
            });

            var channel = pusher.subscribe(`presence-Messenger.${userid}`);
            channel.bind('new-message', function(data) {
                addMessage(data.message);
            });
          </script> --}}
        </div>
    </body>
</html>
