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
                <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                    COINPAYMENTS
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li>
                        <a class="dropdown-item" href="https://www.coinpayments.net/apidoc-code">Docs</a>
                    </li>
                    <li><a class="dropdown-item" href="https://github.com/hexters/CoinPayment">Github</a></li>
                    <li><a class="dropdown-item" href="https://www.coinpayments.net/acct-coins">List coin</a></li>
                </ul>
            </div>
        </div>
        <div class="col-12 mt-4  text-center">
            <div class="card p-3 h50">
                <img src="{{ asset('img/coinpayment.svg') }}" class="">
            </div>
        </div>
        <div class="col-12">
            <div class="p-3">
                <div class="card-body border p-0">
                    <div class="p-3 pt-0" id="collapseExample">
                        <div class="row">
                            <div class="col-12 text-center">
                                <p class="h4 mb-0">Summary</p>
                                <p class="mb-0"><span class="fw-bold">Product:</span><span
                                            class="c-green">: Donate</span></p>
                                <p class="mb-0"><span class="fw-bold">Price:</span><span
                                            class="c-green">: 10$</span></p>
                            </div>

                        </div>
                        <div class="col-12" id="coinpayment">
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
            </tr>
            </thead>
            <tbody>
            @if(!count($payment))
                <tr>
                    <th colspan="4">Không có dữ liệu</th>
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
<script>
    $(function () {
        $('#coinpayment').on('click', function () {
            var amount = 10;
            var url = "/api/payment/coinpayment";
            $.post({
                url: url,
                data: {amount: amount},
                success: function (res) {
                    window.location.href = res.url
                }
            })
        })
    })
</script>
</body>
</html>
