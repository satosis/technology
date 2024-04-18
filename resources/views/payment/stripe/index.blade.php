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
        <div class="col-11">
            <a href="/payment">Quay lại</a>
        </div>
        <div class="col-1 d-flex" style="justify-content: space-around;">
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                    STRIPE
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="https://stripe.com/docs/checkout/quickstart#testing"
                           target="_blank">Tutorial</a></li>
                    <li><a class="dropdown-item" href="https://dashboard.stripe.com/test/webhooks" target="_blank">Webhook</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-12 mt-4">
            <div class="card p-3">
                <img src="{{ asset('img/stripe.png') }}" class="h50">
            </div>
        </div>
        <div class="col-12">
            <div class="p-3">
                <div class="card-body border p-0">
                    <div class="p-3 pt-0" id="collapseExample">
                        <div class="row">
                            <div class="col-6 text-center">
                                <p class="h4 mb-0">Summary</p>
                                <p class="mb-0"><span class="fw-bold">Product:</span><span
                                            class="c-green">: Donate</span></p>
                                <p class="mb-0"><span class="fw-bold">Price:</span><span class="c-green">: 200$</span>
                                </p>
                            </div>
                            <div class="col-6 text-left">
                                <p class="h4 mb-0" style="margin-left: 100px">Test User</p>
                                <p class="mb-0"><span class="fw-bold">Payment succeed:</span><span class="c-green">: 4242 4242 4242 4242</span>
                                </p>
                                <p class="mb-0"><span class="fw-bold">Payment requires authentication:</span><span
                                            class="c-green">: 4000 0025 0000 3155</span></p>
                                <p class="mb-0"><span class="fw-bold">Payment is declined:</span><span class="c-green">: 4000 0000 0000 9995</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-12" id="stripe">
                            <div class="btn btn-primary payment"> Make Payment</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h4 class="text-center">History</h4>
        <table class="table text-center">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Số tiền</th>
                <th scope="col">Trạng thái</th>
                <th scope="col">Code</th>
                <th scope="col">Thời gian</th>
            </tr>
            </thead>
            <tbody>
            @if(!count($payment))
                <tr>
                    <th colspan="5">Không có dữ liệu</th>
                </tr>
            @endif
            @foreach($payment as $key => $list)
                <tr>
                    <th>{{ ++$key }}</th>
                    <th>{{ $list->money }}</th>
                    <td>
                        @if($list->status == 0)
                            Đang chờ
                        @else
                            Thành công
                        @endif
                    </td>
                    <td>{{ $list->code }}</td>
                    <td>{{ $list->created_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="box-footer">
            {!! $payment->links() !!}
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="https://js.stripe.com/v3/"></script>
<script>
    $(function () {
        $('#stripe').on('click', function () {
            var amount = 100;
            var url = "/api/payment/stripe";
            $.post({
                url: url,
                data: {amount: amount},
                success: function (res) {
                    console.log(res);
                    window.location.href = res
                }
            })
        })
    })
</script>
</body>
</html>
