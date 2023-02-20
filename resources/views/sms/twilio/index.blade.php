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
<div class="container">
    <div class="row">
        <div class="col-11">
            <a href="/sms">Quay lại</a>
        </div>
        <div class="col-1 d-flex" style="justify-content: space-around;">
            <!-- <a href="https://www.twilio.com/blog/create-video-conference-app-laravel-php-vue-js">Tutorial</a> -->
        </div>
        <div class="col-12 mt-4">
            <div class="card p-3">
                <img src="{{ asset('img/twilio.png') }}" class="h50">
            </div>
        </div>
    </div>
    <main class="content">
        <div class="container p-0 mt-5">
            <form class="text-center">
                <input type="text" class=" mt-5 text-center form-control" id="phone" autocomplete="off"
                       placeholder="Phone" value="0948561668" disabled>
                <input type="text" class=" mt-5 text-center form-control" id="text" autocomplete="off"
                       placeholder="Text">
                <button type="button" class=" mt-5 btn send btn-primary">Send</button>
            </form>

        </div>
</div>
</main>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>
<script>
    $(function () {
        $('.send').on('click', function () {
            var phone = $("#phone").val();
            var text = $("#text").val();
            var url = "/api/sms/twilio/send";
            $.post({
                url: url,
                data: {phone: phone, text: text},
                success: function () {
                    alert('Success');
                }
            })
        })
    })
</script>
</body>
</html>
