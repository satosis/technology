<?php

namespace App\Http\Controllers\Api\Payment;

use App\Http\Controllers\Controller;
use App\Services\PaypalServices;
use Illuminate\Http\Request;

class PaypalController extends Controller
{
    protected $paypalServices;

    public function __construct(PaypalServices $paypalServices)
    {
        $this->paypalServices = $paypalServices;
    }

    public function paypal(Request $request)
    {
        return $this->paypalServices->paypalTransaction($request);
    }

    public function webhook(Request $request)
    {
        return $this->paypalServices->webhook($request);
    }
}
