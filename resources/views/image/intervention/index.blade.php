<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Team Pega</title>
    <link rel="stylesheet" href="{{ asset('css/image.css') }}">

    <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=PT+Serif:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@1,300&display=swap" rel="stylesheet">
</head>

<body>
<div class="container pt-5">
    <div class="row">
        <div class="col-11">
            <a href="/image">Quay lại</a>
        </div>
        <div class="col-1 d-flex" style="justify-content: space-around;">
            <a href="https://image.intervention.io/v2/introduction/installation">Tutorial</a>
        </div>
        <div class="col-12 mt-4">
            <div class="card p-3 df">
                <img src="{{ asset('img/intervention.png') }}" class="h50">
            </div>
        </div>
    </div>

    <form action="/image/intervention/upload" method="post" class="text-center mt-5" enctype="multipart/form-data">
        @csrf
        <label for="ims" class="btn btn-primary"> Choose Image</label><br>
        <input type="file" name="images" id="ims" class="d-none">
        <input type="submit" value="Submit" class="btn btn-primary mt-3 ">
    </form>
    <div class="crews">
        <div class="human">
            <p class="tw1">PRODUCT OWNER</p>
            <img src="{{ asset('img/photo1.png') }}">
            <p class="t1">Bill Mahoney</p>
        </div>
        <div class="human">
            <p class="tw1 tw12">ART DIRECTOR<span class="vis">A</span></p>
            <img class="humanx" src="{{ asset('img/photo2.png') }}">
            <p class="t1 humanx">Saba Cabrera</p>
        </div>
        <div class="human">
            <p class="tw1">TECH LEAD<span class="vis">AAAAA</span></p>
            <img src="{{ asset('img/photo3.png') }}">
            <p class="t1">Shae Le</p>
        </div>
        <div class="human">
            <p class="tw1">UX DESİGNER<span class="vis">AAA</span></p>
            <img src="{{ asset('img/photo4.png') }}">
            <p class="t1">Skylah Lu</p>
        </div>
        <div class="human hu">
            <p class="tw1 tw12">DEVELOPER<span class="vis">AAAA</span></p>
            <img class="humanx" src="{{ asset('img/photo5.png') }}">
            <p class="t1 humanx">Griff Richards</p>
        </div>
        <div class="human humany">
            <p class="tw1">DEVELOPER<span class="vis">AAAA</span></p>
            <img src="{{ asset('img/photo6.png') }}">
            <p class="t1">Stan Jhon</p>

        </div>
    </div>
    <div class="fter"><h3 class="footer">muhsin61@DevChallenge.org</h3></div>

</body>
<script src="{{ asset('js/bootstrap.js') }}"></script>

</html>
