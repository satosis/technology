<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha512-MoRNloxbStBcD8z3M/2BmnT+rg4IsMxPkXaGh2zD6LGNNFE80W3onsAhRcMAMrSoyWL9xD7Ert0men7vR8LUZg=="
          crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css"/>
    <link href="https://getdatepicker.com/5-4/theme/css/tempusdominus-bootstrap-4.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
            integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.0/moment-with-locales.min.js"
            integrity="sha512-EATaemfsDRVs6gs1pHbvhc6+rKFGv8+w4Wnxk4LmkC0fzdVoyWb+Xtexfrszd1YuUMBEhucNuorkf8LpFBhj6w=="
            crossorigin="anonymous"></script>
    <script src="https://getdatepicker.com/5-4/theme/js/tempusdominus-bootstrap-4.js"></script>
</head>
<body>
<div class="container mt-3">
    <div class="row">
        <div class="col-10">
            <a href="/">Quay lại</a>
        </div>
        <div class="col-1 d-flex" style="justify-content: space-around;">
            <a href="https://getdatepicker.com/5-4/Usage/#bootstrap4-v5-docs">Bootstrap</a>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 mt-3">
            <div class="form-group">
                <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker1"/>
                    <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(function () {
                var date = new Date().toLocaleString('ja-JP', {timeZone: 'Asia/Tokyo'});
                ;
                $('#datetimepicker1').datetimepicker({
                    format: 'YYYY/MM/DD HH:mm',
                    minDate: date,
                    defaultDate: date,
                    sideBySide: true,
                    allowInputToggle: true
                });
            });
        </script>
    </div>
</body>
</html>
