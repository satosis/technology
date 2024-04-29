<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <title>Trang chủ</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-10">
            <a href="/">Quay lại</a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 mb-3">
            <a href="/chat/twilio" class="no-deco">
                <div class="card p-3">
                    <div class="img-box"><img src="{{ asset('img/twilio.png') }}" class="h50" alt=""></div>
                </div>
            </a>
        </div>
        <div class="col-lg-4 mb-3">
            <a href="/chat/pusher" class="no-deco">
                <div class="card p-3">
                    <div class="img-box"><img src="{{ asset('img/pusher.png') }}" class="h50" alt=""></div>
                </div>
            </a>
        </div>
        <div class="col-lg-4 mb-3">
            <a href="/chat/cbox" class="no-deco">
                <div class="card p-3">
                    <div class="img-box"><img src="{{ asset('img/cbox.png') }}" class="h50" alt=""></div>
                </div>
            </a>
        </div>
        <div class="col-lg-4 mb-3">
            <a href="/chat/chatra" class="no-deco">
                <div class="card p-3">
                    <div class="img-box"><img src="{{ asset('img/chatra.png') }}" class="h50" alt=""></div>
                </div>
            </a>
        </div>
    </div>
</div>
<script src="{{ asset('js/bootstrap.js') }}"></script>
<script src="{{ asset('js/jquery.js') }}"></script>
</body>
</html>
