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
        <div class="col-2 d-flex" style="justify-content: space-around;">
        <a href="">Docs</a>
        </div>
        <div class="col-12 mt-4">
            <div class="card p-3">
                <img src="{{ asset('img/paypal.png') }}" class="h50">
            </div>
        </div>
        <div class="col-12">
            <div class="card p-3">
                <div class="card-body border p-0">
                    <div class="p-3 pt-0" id="collapseExample">
                        <div class="row">
                            <div class="col-6 text-center">
                                <p class="h4 mb-0">Summary</p>
                                <p class="mb-0"><span class="fw-bold">Product:</span><span class="c-green">: Donate</span></p>
                                <p class="mb-0"><span class="fw-bold">Price:</span><span class="c-green">: 100$</span></p>
                            </div>
                            <div class="col-6 text-center">
                                <p class="h4 mb-0">Test User</p>
                                <p class="mb-0"><span class="fw-bold">Email:</span><span class="c-green">: sb-jvln11575580@personal.example.com</span></p>
                                <p class="mb-0"><span class="fw-bold">Password:</span><span class="c-green">: 6PfnUkpvGl</span></p>
                            </div>
                        </div>
                    <div class="col-12" id="paypal" >
                        <div class="btn btn-primary payment"> Make Payment </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <h4 class="text-center mt-5">History</h4>
            <table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">First</th>
        <th scope="col">Last</th>
        <th scope="col">Handle</th>
        </tr>
    </thead>
    <tbody>
        <tr>
        <th scope="row">1</th>
        <td>Mark</td>
        <td>Otto</td>
        <td>@mdo</td>
        </tr>
        <tr>
        <th scope="row">2</th>
        <td>Jacob</td>
        <td>Thornton</td>
        <td>@fat</td>
        </tr>
        <tr>
        <th scope="row">3</th>
        <td colspan="2">Larry the Bird</td>
        <td>@twitter</td>
        </tr>
    </tbody>
    </table>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $(function(){
        $('#paypal').on('click',function(){
            var amount = 100;
            var url = "/api/paypal";
            $.post({
                url:url,
                data:{amount:amount},
                success : function(res){
                    window.location.href = res
                }
            })
        })
    })
</script>
</body>
</html>