<?php

namespace App\Http\Controllers\Api\Payment;

use App\Http\Controllers\Controller;
use App\Services\VnpayServices;
use Illuminate\Http\Request;

class VnpayController extends Controller
{
    protected $vnpayServices;

    public function __construct(VnpayServices $vnpayServices)
    {
        $this->vnpayServices = $vnpayServices;
    }

    public function vnpay(Request $request)
    {
        return $this->vnpayServices->vnpayTransaction($request);
    }

    public function callback(Request $request)
    {
        return $this->vnpayServices->callback($request);
    }
}
