<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" defer></script>
    <title>Login</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-8">
            <a href="/">Quay lại</a>
        </div>
        <div class="col-4 d-flex" style="justify-content: space-around;align-items: center;margin-bottom:15px">
            <div class="dropdown">
                <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                    LINE
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="{{ asset('docs/line_setup.docx') }}" class="text-right">Tài
                            liệu</a></li>
                    <li><a class="dropdown-item" href="https://developers.line.biz/ja/reference/line-login">Login</a>
                    </li>
                    <li><a class="dropdown-item"
                           href="https://developers.line.biz/en/docs/line-login/integrate-line-login/#applying-for-email-permission">Add
                            email </a></li>
                    <li><a class="dropdown-item"
                           href="https://developers.line.biz/en/docs/line-login/link-a-bot/#displaying-the-option-to-add-your-line-official-account-as-a-friend">Add
                            friend</a></li>
                    <li><a href="https://developers.line.biz/console/channel/1657089077/messaging-api"
                           class="dropdown-item">Add webhook</a></li>
                </ul>
            </div>
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                    GOOGLE
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item"
                           href="https://viblo.asia/p/login-google-api-trong-laravel-7x-LzD5d1VwKjY" class="text-right">Tutorial</a>
                    </li>
                    <li><a class="dropdown-item"
                           href="https://console.cloud.google.com/apis/credentials?hl=vi&project=test-web-344515">Config</a>
                    </li>
                </ul>
            </div>
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                    FACEBOOK
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item"
                           href="https://developers.facebook.com/apps/325986579363528/settings/basic/">Config</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 mb-lg-0 mb-3">
            <a href="/login/line" class="no-deco">
                <div class="card p-3" id="line">
                    <img src="{{ asset('img/line.png') }}" class="h50" alt="">
                </div>
            </a>
        </div>
        <div class="col-lg-4 mb-lg-0 mb-3">
            <a href="/login/facebook" class="no-deco">
                <div class="card p-3">
                    <img src="{{ asset('img/facebook.png') }}" class="h50" alt="">
                </div>
            </a>
        </div>
        <div class="col-lg-4 mb-lg-0 mb-3">
            <a href="/login/google" class="no-deco">
                <div class="card p-3">
                    <img src="{{ asset('img/google.png') }}" class="h50" alt="">
                </div>
            </a>
        </div>
        <div class="col-12 mt-4">
            <div class="card p-3">
                <p class="mb-0 fw-bold h4">Login Methods</p>
            </div>
        </div>
        <div class="col-12">
            <div class="p-3">
                <div class="card-body border p-0">
                    <p><a class="btn btn-primary w-100 h-100 d-flex align-items-center justify-content-between"
                          data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="true"
                          aria-controls="collapseExample"> <span class="fw-bold">Line</span> <span
                                    class="fab fa-cc-paypal"> </span> </a></p>
                    <div class="collapse show p-3 pt-0" id="collapseExample">
                        <div class="row">
                            <div class="col-8">
                                <p class="h4 mb-0">Lưu ý</p>
                                <p class="mb-0">Trước khi đăng nhập bằng Line , bạn cần kết bạn với tài khoản Line
                                    Official Account</p>
                                <p class="mb-0"><span class="fw-bold">QR code:</span></p>
                                <img src="{{ asset('img/qrcode-line.png') }}" alt="QRcode" style="height:150px"></img>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script src="{{ asset('js/bootstrap.js') }}"></script>
<script src="{{ asset('js/jquery.js') }}"></script>
</body>
</html>
