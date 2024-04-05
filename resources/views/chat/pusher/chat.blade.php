<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
    <meta name="friendId" content="{{ $otherUser->id }}">
    <meta name="userId" content="{{ $authUser->id }}">

    <title>Trang chủ</title>
</head>
<body>
<div class="container" id="app">
    <div class="row">
        <div class="col-11">
            <a href="/chat">Quay lại</a>
        </div>
        <div class="col-1 d-flex" style="justify-content: space-around;">
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                    PUSHER
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="{{ asset('docs/pusher_setup.docx') }}">Tài liệu</a></li>
                    <li><a class="dropdown-item" href="https://www.youtube.com/watch?v=OxuojwY9wXc&t=2059s">Tutorial</a>
                    </li>
                    <li><a class="dropdown-item" href="https://pusher.com/tutorials/chat-laravel">Tutorial Chat</a></li>
                    <li><a class="dropdown-item" href="https://pusher.com/tutorials/photo-feed-laravel">Tutorial
                            File</a></li>
                    <li><a class="dropdown-item" href="https://pusher.com/channels/pricing">Price</a></li>
                </ul>
            </div>
        </div>
        <div class="col-12 mt-4">
            <div class="card p-3">
                <img src="{{ asset('img/pusher.png') }}" class="h50">
            </div>
        </div>
    </div>
    <main class="content">
        <div class="container p-0">
            <div class="row g-0">
                <div class="col-12 col-lg-5 col-xl-3 border-right" style="height: 620px;overflow: auto;">
                    <div class="px-4 d-none d-md-block">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <input type="text" class="form-control my-3" placeholder="Search...">
                            </div>
                        </div>
                    </div>
                    @foreach($user as $list)
                        <a href="/chat/pusher/{{ $list->id }}" class="list-group-item list-group-item-action border-0">
                            <div class="d-flex align-items-start">
                                <img src="{{ $list->avatar }}" class="rounded-circle mr-1"
                                     onerror="this.src='/img/avatar1.png';" width="40" height="40">
                                <div class="flex-grow-1 ml-3">
                                    {{ $list->name }}
                                    <div class="small"><span class="fas fa-circle chat-offline"></span> Offline</div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                    <hr class="d-block d-lg-none mt-1 mb-0">
                </div>
                <pusher-chat-component :auth-user="{{ $authUser }}" :other-user="{{ $otherUser }}"
                                       :chats="{{ $chat }}"></pusher-chat-component>
            </div>
        </div>
    </main>
</div>
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>
<script>
</script>
</body>
</html>
