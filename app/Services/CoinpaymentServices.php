<?php

namespace App\Services;

use App\Models\Payment;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Hexters\CoinPayment\CoinPayment;
use Illuminate\Http\Request;

class CoinpaymentServices
{

    public function coinpaymentTransaction($request)
    {
        $code = 'SA-'. strtoupper(Str::random(10));
        Payment::create([
            'name' => "Thanh toán qua coinpayment",
            'money' => $request->amount,
            'gate' => 'coinpayment',
            'status' => 0,
            'code' => $code
        ]);
       /*
        *   @required true
        */
        $transaction['order_id'] = $code; // invoice number
        $transaction['amountTotal'] = (FLOAT) $request->amount;
        $transaction['note'] = 'Transaction note';
        $transaction['buyer_name'] = 'User test';
        $transaction['buyer_email'] = 'user@test.com';
        $transaction['redirect_url'] = url("/api/payment/coinpayment/callback?code=" .$code); // When Transaction was comleted
        $transaction['cancel_url'] = url("/api/payment/coinpayment/callback?code=" .$code); // When user click cancel link


        /*
        *   @required true
        *   @example first item
        */
        $transaction['items'][] = [
            'itemDescription' => 'Product one',
            'itemPrice' => (FLOAT) 3, // USD
            'itemQty' => (INT) 1,
            'itemSubtotalAmount' => (FLOAT) 3 // USD
        ];

        /*
        *   @example second item
        */
        $transaction['items'][] = [
            'itemDescription' => 'Product two',
            'itemPrice' => (FLOAT) 3, // USD
            'itemQty' => (INT) 1,
            'itemSubtotalAmount' => (FLOAT) 3 // USD
        ];

        /*
        *   @example third item
        */
        $transaction['items'][] = [
            'itemDescription' => 'Product Three',
            'itemPrice' => (FLOAT) 2, // USD
            'itemQty' => (INT) 2,
            'itemSubtotalAmount' => (FLOAT) 4 // USD
        ];

        $transaction['payload'] = [
            'foo' => [
                'bar' => 'baz'
            ]
        ];
        return ['url' => CoinPayment::generatelink($transaction)];
    }

    public function callback(Request $request)
    {
        $code = $request->code;
        dd(CoinPayment::getBalances());
        return redirect()->to('/payment/coinpayment');
    }

}
