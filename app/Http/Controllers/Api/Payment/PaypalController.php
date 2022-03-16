<?php

namespace App\Http\Controllers\Api\Payment;

use Illuminate\Http\Request;
use App\Services\PaypalServices;
use App\Http\Controllers\Controller;

class PaypalController extends Controller
{
    protected $paypalServices;
    public function __construct(PaypalServices $paypalServices)
    {
        $this->paypalServices  = $paypalServices;
    } 
    public function paypal(Request $request)
    {
        $result = $this->paypalServices->paypalTransaction($request);
        return response()->json($result);
    }
}
