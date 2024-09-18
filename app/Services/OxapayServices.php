<?php

namespace App\Services;

use App\Models\Payment;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Payment as Pay;

class OxapayServices
{

    public function invoice($request)
    {

        $url = 'https://api.oxapay.com/merchants/request';

        $orderId = 'OXAPAY-'. strtoupper(Str::random(10));

        $data = array(
            'merchant' => config('env.oxapay.api_key'),
            'amount' => $request->amount,
            'currency' => 'TRX',
            'lifeTime' => 30,
            'feePaidByPayer' => 0,
            'underPaidCover' => 2.5,
            'callbackUrl' => config('env.app_url') . '/callback',
            'returnUrl' => config('env.app_url'),
            'description' => 'Order #12345',
            'orderId' => $orderId,
            'email' => 'customer@example.com'
        );
        $result = execPostRequest($url, json_encode($data));
        Pay::create([
            'name' => "Thanh toán qua Oxapay",
            'money' => $request->amount,
            'gate' => 'oxapay',
            'status' => 0,
            'code' => $orderId
        ]);
        $result = json_decode($result);
        return $result->payLink;
    }

}
