<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
    <title>Trang chủ</title>
</head>
<body>
<div class="container" id="app">
    <div class="row">
        <div class="col-9">
            <a href="/chat">Quay lại</a>
        </div>
        <div class="col-3 d-flex" style="justify-content: space-around;align-items: center;margin-bottom:15px">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                    Twilio Conversation tutorial
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="{{ asset('docs/twilio.docx') }}" class="text-right">Tài liệu</a>
                    </li>
                    <li><a class="dropdown-item"
                           href="https://www.twilio.com/docs/conversations/javascript/exploring-conversations-javascript-quickstart#sending-messages-to-a-conversation">Docs
                            conversation with vuejs</a></li>
                    <li><a class="dropdown-item"
                           href="https://www.twilio.com/docs/conversations/media-support-conversations">Upload
                            media </a></li>
                    <li><a class="dropdown-item" href="https://www.twilio.com/conversations/pricing">Price</a></li>
                </ul>
            </div>
        </div>

        <div class="col-12 mt-4">
            <div class="card p-3">
                <img src="{{ asset('img/twilio.png') }}" class="h50">
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
                        <a href="/chat/twilio/{{ $list->id }}" class="list-group-item list-group-item-action border-0">
                            <div class="d-flex align-items-start">
                                <img src="{{ $list->avatar }}" class="rounded-circle mr-1" alt="{{ $list->name }}"
                                     width="40" height="40">
                                <div class="flex-grow-1 ml-3">
                                    {{ $list->name }}
                                    <div class="small"><span class="fas fa-circle chat-offline"></span> Offline</div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                    <hr class="d-block d-lg-none mt-1 mb-0">
                </div>
                <twilio-chat-component :auth-user="{{ $authUser }}" :other-user="{{ $otherUser }}"
                                       :chat="{{ $chat }}"></twilio-chat-component>
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
