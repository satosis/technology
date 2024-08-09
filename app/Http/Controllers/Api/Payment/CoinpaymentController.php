<?php

namespace App\Http\Controllers\Api\Payment;

use App\Http\Controllers\Controller;
use App\Services\CoinpaymentServices;
use Illuminate\Http\Request;

class CoinpaymentController extends Controller
{
    protected $coinpaymentServices;

    public function __construct(CoinpaymentServices $coinpaymentServices)
    {
        $this->coinpaymentServices = $coinpaymentServices;
    }

    public function coinpayment(Request $request)
    {
        $result = $this->coinpaymentServices->coinpaymentTransaction($request);
        return response()->json($result);
    }

    public function callback(Request $request)
    {
        return $this->coinpaymentServices->callback($request);
    }
}
