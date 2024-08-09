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
            <a href="/payment/paypay" class="no-deco">
                <div class="card p-3">
                    <img src="{{ asset('img/paypay.svg') }}" class="h50">
                </div>
            </a>
        </div>
        <div class="col-lg-4 mb-3">
            <a href="/payment/paypal" class="no-deco">
                <div class="card p-3">
                    <img src="{{ asset('img/paypal.png') }}" class="h50">
                </div>
            </a>
        </div>
        <div class="col-lg-4 mb-3">
            <a href="/payment/stripe" class="no-deco">
                <div class="card p-3">
                    <img src="{{ asset('img/stripe.png') }}" class="h50">
                </div>
            </a>
        </div>
        <div class="col-lg-4 mb-3">
            <a href="/payment/vnpay" class="no-deco">
                <div class="card p-3">
                    <img src="{{ asset('img/vnpay.svg') }}" class="h50">
                </div>
            </a>
        </div>
        <div class="col-lg-4 mb-3">
            <a href="/payment/momo" class="no-deco">
                <div class="card p-3">
                    <img src="{{ asset('img/momo.png') }}" class="h50">
                </div>
            </a>
        </div>
        <div class="col-lg-4 mb-3">
            <a href="/payment/coinpayment" class="no-deco">
                <div class="card p-3">
                    <img src="{{ asset('img/coinpayment.svg') }}" class="h50">
                </div>
            </a>
        </div>
        <div class="col-12 mt-4">
            <div class="card p-3">
                <p class="mb-0 fw-bold h4">Payment Methods</p>
            </div>
        </div>
        <div class="col-12">
            <div class="p-3">
                <div class="card-body border p-0">
                    <p><a class="btn btn-primary w-100 h-100 d-flex align-items-center justify-content-between"
                          data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="true"
                          aria-controls="collapseExample"> <span class="fw-bold">PayPal</span> <span
                                    class="fab fa-cc-paypal"> </span> </a></p>
                    <div class="collapse p-3 pt-0" id="collapseExample">
                        <div class="row">
                            <div class="col-8">
                                <p class="h4 mb-0">Summary</p>
                                <p class="mb-0"><span class="fw-bold">Product:</span><span class="c-green">: Name of product</span>
                                </p>
                                <p class="mb-0"><span class="fw-bold">Price:</span><span class="c-green">:$100</span>
                                </p>
                                <p class="mb-0">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Atque nihil
                                    neque quisquam aut repellendus, dicta vero? Animi dicta cupiditate, facilis
                                    provident quibusdam ab quis, iste harum ipsum hic, nemo qui!</p>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="btn btn-primary payment"> Make Payment</div>
                        </div>
                    </div>
                </div>
                <div class="card-body border p-0">
                    <p><a class="btn btn-primary p-2 w-100 h-100 d-flex align-items-center justify-content-between"
                          data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="true"
                          aria-controls="collapseExample"> <span class="fw-bold">Credit Card</span> <span
                                    class=""> <span class="fab fa-cc-amex"></span> <span
                                        class="fab fa-cc-mastercard"></span> <span
                                        class="fab fa-cc-discover"></span> </span> </a></p>
                    <div class="collapse show p-3 pt-0" id="collapseExample">
                        <div class="row">
                            <div class="col-lg-5 mb-lg-0 mb-3">
                                <p class="h4 mb-0">Summary</p>
                                <p class="mb-0"><span class="fw-bold">Product:</span><span class="c-green">: Name of product</span>
                                </p>
                                <p class="mb-0"><span class="fw-bold">Price:</span> <span class="c-green">:$100</span>
                                </p>
                                <p class="mb-0">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Atque nihil
                                    neque quisquam aut repellendus, dicta vero? Animi dicta cupiditate, facilis
                                    provident quibusdam ab quis, iste harum ipsum hic, nemo qui!</p>
                            </div>
                            <div class="col-lg-7">
                                <form action="" class="form">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form__div"><input type="text" class="form-control"
                                                                          placeholder=" "> <label for=""
                                                                                                  class="form__label">Card
                                                    Number</label></div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form__div"><input type="text" class="form-control"
                                                                          placeholder=" "> <label for=""
                                                                                                  class="form__label">MM
                                                    / yy</label></div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form__div"><input type="password" class="form-control"
                                                                          placeholder=" "> <label for=""
                                                                                                  class="form__label">cvv
                                                    code</label></div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form__div"><input type="text" class="form-control"
                                                                          placeholder=" "> <label for=""
                                                                                                  class="form__label">name
                                                    on the card</label></div>
                                        </div>
                                        <div class="col-12">
                                            <div class="btn btn-primary w-100">Sumbit</div>
                                        </div>
                                    </div>
                                </form>
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
