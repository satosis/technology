<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <title>Profile</title>
</head>
<body>
<style>
    .image {
        background: url("{{ \Auth::user()->avatar ?? '/img/man.jpg'}}") center center no-repeat;
        background-size: cover;
    }
</style>
<head>

    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">

    <link href='https://fonts.googleapis.com/css?family=Lato:400,300' rel='stylesheet' type='text/css'>
</head>
<div class="box">
    <div id="overlay">
        <div class="image">
            <div class="trick">

            </div>
        </div>
        <ul class="text">{{ \Auth::user()->name }}</ul>
        <div class="text1">{{ \Auth::user()->email }}</div>
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
                <div class="panel-heading " role="tab" id="headingOne">
                    <h4 class="panel-title ">
                        <a href="/">
                            <div class="title  btn btn-danger btn-outline btn-lg">Quay lại</div>
                        </a>
                    </h4>
                </div>

            </div>
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingThree">
                    <h4 class="panel-title">
                        @if(\Auth::user()->provider_name == 'line')
                            <a href="https://developers.line.biz/console/channel/1656989192/liff/1656989192-xjXj50Gl">
                                <div class="title btn btn-danger btn-outline btn-lg">Config Line</div>
                            </a>
                        @endif
                        @if(\Auth::user()->provider_name == 'google')
                            <a href="https://console.cloud.google.com/apis/credentials/oauthclient/184147581794-88jhhff78j5etdctce938d6mfgvsc6q9.apps.googleusercontent.com?hl=vi&project=test-web-344515">
                                <div class="title btn btn-danger btn-outline btn-lg">Config Google</div>
                            </a>
                        @endif
                        @if(\Auth::user()->provider_name == 'facebook')
                            <a href="https://developers.facebook.com/apps/325986579363528/dashboard/">
                                <div class="title btn btn-danger btn-outline btn-lg">Config Facebook</div>
                            </a>
                        @endif
                    </h4>
                </div>
                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                    <div class="panel-body">
                        <form id="form" class="topBefore">
                            <input id="name" type="text" placeholder="NAME">
                            <input id="email" type="text" placeholder="E-MAIL">
                            <textarea id="message" type="text" placeholder="MESSAGE"></textarea>
                            <input id="submit" type="submit" value="Submit Now!">
                        </form>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>