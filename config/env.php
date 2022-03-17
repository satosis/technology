<?php
return [
    'app_url'                   => env('APP_URL',null),
    'paypay_key'                => env('PAYPAY_KEY', null),
    'paypay_secret'             => env('PAYPAY_SECRET', null),
    'paypay_merchant'           => env('PAYPAY_MERCHANT_ID', null),
    'client_id' => env('PAYPAL_CLIENT_ID'),
    'secret' => env('PAYPAL_SECRET'),
    'settings' => [
    	// PayPal mode, sanbox hoặc live
        'mode' => env('PAYPAL_MODE'),
        // Thời gian của một kết nối (tính bằng giây)
        'http.ConnectionTimeOut' => 30,
        // Có ghi log khi xảy ra lỗi
        'log.logEnabled' => true,
        // Đường dẫn đền file sẽ ghi log
        'log.FileName' => storage_path() . '/logs/paypal.log',
        // Kiểu log
        'log.LogLevel' => 'FINE'
    ],
    'stripe_api_key'             => env('STRIPE_API_KEY', null),
    'stripe_secret_key'          => env('STRIPE_SECRET_KEY', null),
]; 