<?php
return [
    'app_url'   => env('APP_URL',null),
    'paypay' => [
        'key'      => env('PAYPAY_KEY', null),
        'secret'   => env('PAYPAY_SECRET', null),
        'merchant' => env('PAYPAY_MERCHANT_ID', null),
    ],
    'paypal' => [
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
    ],
    'stripe' => [
        'key'        => env('STRIPE_API_KEY', null),
        'secret_key' => env('STRIPE_SECRET_KEY', null),
    ],
    'line' => [
        'liff_id' => env('LINE_LIFF_ID'),
        'liff_channel_id' => env('LINE_LIFF_CHANNEL_ID'),
        'channel_id' => env('LINE_CHANNEL_ID'),
        'channel_secret' => env('LINE_CHANNEL_SECRET'),
        'channel_token' => env('LINE_CHANNEL_TOKEN'),
        'callback' => env('LINE_CALLBACK_URL'),
        'verify' => 'https://api.line.me/oauth2/v2.1/verify',
        'profile' => 'https://api.line.me/v2/profile',
        'token' => 'https://api.line.me/oauth2/v2.1/token',
    ],
    'twilio' => [
        'account_sid'        => env('TWILIO_AUTH_SID',null),
        'api_key_sid'        => env('TWILIO_API_SID', null),
        'api_key_secret'     => env('TWILIO_API_SECRET', null),
        'account_token'      => env('TWILIO_AUTH_TOKEN', null),
        'service_id'         => env('TWILIO_SERVICE_SID', null),
    ],
    'nexmo' => [
        'key'        => env('NEXMO_KEY',null),
        'secret'     => env('NEXMO_SECRET', null),
        'sender'     => env('NEXMO_FROM_SEND', null),
    ],
    'vnpay' => [
        'code'        => env('VNPAY_CODE',null),
        'secret'     => env('VNPAY_SECRET', null),
        'url'     => "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html",
        'callback' => env('VNPAY_CALLBACK_URL', null),
    ],
    'momo' => [
        'partner_code'   => env('MOMO_PARTNER_CODE',null),
        'access_key'     => env('MOMO_ACCESS_KEY', null),
        'secret_key'     => env('MOMO_SECRET_KEY', null),
        'callback_url' => env('MOMO_CALLBACK_URL', null),
    ],
    'coinpayment' => [
        'public_key'   => env('COINPAYMENTS_PUBLIC_KEY',null),
        'private_key'  => env('COINPAYMENTS_PRIVATE_KEY', null),
    ],
    'oxapay' => [
        'api_key'   => env('OXAPAY_API_KEY',null),
    ],
    'turnstile' => [
        'key'      => env('TURNSTILE_SITE_KEY', null),
        'secret'   => env('TURNSTILE_SECRET_KEY', null),
    ],
];
