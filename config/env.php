<?php
return [
    'app_url'                   => env('APP_URL',null),
    //paypay
    'paypay_key'                => env('PAYPAY_KEY', null),
    'paypay_secret'             => env('PAYPAY_SECRET', null),
    'paypay_merchant'           => env('PAYPAY_MERCHANT_ID', null),
    //paypal
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
    //stripe
    'stripe_api_key'             => env('STRIPE_API_KEY', null),
    'stripe_secret_key'          => env('STRIPE_SECRET_KEY', null),
    //line
        //line login
    'liff_id' => env('LINE_LIFF_ID', 'LINE_LIFF_ID'),
    'liff_channel_id' => env('LINE_LIFF_CHANNEL_ID', 'LINE_LIFF_CHANNEL_ID'),
        // line message
    'channel_id' => env('LINE_CHANNEL_ID', 'LINE_CHANNEL_ID'),
    'channel_secret' => env('LINE_CHANNEL_SECRET', 'LINE_CHANNEL_SECRET'),
    'channel_token' => env('LINE_CHANNEL_TOKEN', 'LINE_CHANNEL_TOKEN')
]; 