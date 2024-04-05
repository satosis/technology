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
    <style>
        .Connected {
            border: 1px solid #eee;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-9">
            <a href="/chat">Quay lại</a>
        </div>
        <div class="col-3 d-flex" style="justify-content: space-around;">
            <a href="https://www.cbox.ws/admin?home">Tutorial</a>
        </div>
        <div class="col-12 mt-4">
            <div class="card p-3">
                <img src="{{ asset('img/cbox.png') }}" class="h50">
            </div>
        </div>
    </div>
    <main class="content">
        <div class="container p-0">
            <iframe src="https://www5.cbox.ws/box/?boxid=933605&boxtag=mS51WF" width="100%" height="450"
                    allowtransparency="yes" allow="autoplay" frameborder="0" marginheight="0" marginwidth="0"
                    scrolling="auto"></iframe>
        </div>
    </main>
</div>
<script src="https://media.twiliocdn.com/sdk/js/chat/v3.3/twilio-chat.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>
<script>
    $(function () {
        $('#paypal').on('click', function () {
            var amount = 100;
            var url = "/api/payment/paypal";
            $.post({
                url: url,
                data: {amount: amount},
                success: function (res) {
                    window.location.href = res
                }
            })
        })
    })
</script>
</body>
</html>
