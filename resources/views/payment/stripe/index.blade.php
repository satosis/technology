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
        <a href="https://viblo.asia/p/dung-thu-stripe-phan-1-maGK7j1D5j2">Docs</a>
        </div>
        <div class="col-12 mt-4">
            <div class="card p-3">
                <img src="{{ asset('img/stripe.png') }}" class="h50">
            </div>
            <div class="card-body border p-0">
                    <p> <a class="btn btn-primary p-2 w-100 h-100 d-flex align-items-center justify-content-between"> <span class="fw-bold">Credit Card</span> <span class=""> <span class="fab fa-cc-amex"></span> <span class="fab fa-cc-mastercard"></span> <span class="fab fa-cc-discover"></span> </span> </a> </p>
                    <div class="collapse show p-3 pt-0" id="collapseExample">
                        <div class="row">
                            <div class="col-lg-5 mb-lg-0 mb-3">
                                <p class="h4 mb-0">Summary</p>
                                <p class="mb-0"><span class="fw-bold">Product:</span><span class="c-green">: Donate</span> </p>
                                <p class="mb-0"> <span class="fw-bold">Price:</span> <span class="c-green">:$100</span> </p>
                            </div>
                            <div class="col-lg-7">
                                <form action="" class="form" >
                                    <div class="row">
                                        <div id="card-errors" class="text-danger"></div>
                                        <div class="col-12">
                                            <div class="form__div"> <input type="text" id="number" class="form-control" placeholder=" "> <label for="" class="form__label">Card Number</label> </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form__div"> <input type="text" id="exp" class="form-control" placeholder=" "> <label for="" class="form__label">MM / yy</label> </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form__div"> <input type="password" id="cvv" class="form-control" placeholder=" "> <label for="" class="form__label">cvv code</label> </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form__div"> <input type="text" id="name" class="form-control" placeholder=" "> <label for="" class="form__label">name on the card</label> </div>
                                        </div>
                                        <div class="col-12">
                                            <buton type="button" id="stripe" class="btn btn-primary w-100">Sumbit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
         
        <h4 class="text-center mt-5">History</h4>
            <table class="table text-center">
            <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Số tiền </th>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://js.stripe.com/v3/"></script>   
<script>
    $(function(){
        $('#stripe').on('click',function(){
            var number = $('#number').val();
            var exp = $('#exp').val();
            var cvv = $('#cvv').val();
            var name = $('#name').val();
            var url = "/api/stripe/register";
            $.get({
                
            })
        })
    })

</script>
</body>
</html>