<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
</head>
<style>
    .navbar-nav {
        width: 100%;
    }

    @media (min-width: 568px) {
        .end {
            margin-left: auto;
        }
    }

    @media (max-width: 768px) {
        #post {
            width: 100%;
        }
    }

    #clicked {
        padding-top: 1px;
        padding-bottom: 1px;
        text-align: center;
        width: 100%;
        background-color: #ecb21f;
        border-color: #a88734 #9c7e31 #846a29;
        color: black;
        border-width: 1px;
        border-style: solid;
        border-radius: 13px;
    }

    #profile {
        background-color: unset;

    }

    #post {
        margin: 10px;
        padding: 6px;
        padding-top: 2px;
        padding-bottom: 2px;
        text-align: center;
        background-color: #ecb21f;
        border-color: #a88734 #9c7e31 #846a29;
        color: black;
        border-width: 1px;
        border-style: solid;
        border-radius: 13px;
        width: 50%;
    }

    body {
        background-color: black;
    }

    #nav-items li a, #profile {
        text-decoration: none;
        color: rgb(224, 219, 219);
        background-color: black;
    }


    .comments {
        margin-top: 5%;
        margin-left: 20px;
    }

    .darker {
        border: 1px solid #ecb21f;
        background-color: black;
        float: right;
        border-radius: 5px;
        padding-left: 40px;
        padding-right: 30px;
        padding-top: 10px;
    }

    .comment {
        border: 1px solid rgba(16, 46, 46, 1);
        background-color: rgba(16, 46, 46, 0.973);
        float: left;
        border-radius: 5px;
        padding-left: 40px;
        padding-right: 30px;
        padding-top: 10px;

    }

    .comment h4, .comment span, .darker h4, .darker span {
        display: inline;
    }

    .comment p, .comment span, .darker p, .darker span {
        color: rgb(184, 183, 183);
    }

    h1, h4 {
        color: white;
        font-weight: bold;
    }

    label {
        color: rgb(212, 208, 208);
    }

    #align-form {
        margin-top: 20px;
    }

    .form-group p a {
        color: white;
    }

    #checkbx {
        background-color: black;
    }

    #darker img {
        margin-right: 15px;
        position: static;
    }

    .form-group input, .form-group textarea {
        background-color: black;
        border: 1px solid rgba(16, 46, 46, 1);
        border-radius: 12px;
    }

    form {
        border: 1px solid rgba(16, 46, 46, 1);
        background-color: rgba(16, 46, 46, 0.973);
        border-radius: 5px;
        padding: 20px;
    }
</style>
<body>
<nav class="navbar navbar-expand-sm navbar-dark">
    <img src="https://i.imgur.com/CFpa3nK.jpg" width="20" height="20" class="d-inline-block align-top rounded-circle"
         alt="">
    <a class="navbar-brand ml-2" href="#" data-abc="true">{{ \Auth::user()->name }}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02"
            aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="end">
        <div class="collapse navbar-collapse" id="navbarColor02">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="#" data-abc="true">Work</a></li>
                <li class="nav-item"><a class="nav-link" href="#" data-abc="true">Capabilities</a></li>
                <li class="nav-item "><a class="nav-link" href="#" data-abc="true">Articles</a></li>
                <li class="nav-item active"><a class="nav-link mt-2" href="#" data-abc="true" id="clicked">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- Main Body -->
<section id="app">
    <div class="container">
        <pusher-comment-component :auth-user="{{ \Auth::user() }}"
                                  :comments="{{ $comment }}"></pusher-comment-component>
    </div>
</section>
</body>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</html>