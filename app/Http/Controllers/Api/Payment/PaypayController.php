<?php

namespace App\Http\Controllers\Api\Payment;

use App\Http\Controllers\Controller;
use App\Services\PaypayServices;
use Illuminate\Http\Request;

class PaypayController extends Controller
{
    protected $paypayServices;

    public function __construct(PaypayServices $paypayServices)
    {
        $this->paypayServices = $paypayServices;
    }

    public function paypay(Request $request)
    {
        $result = $this->paypayServices->paypayTransaction($request);
        return response()->json($result);
    }

    public function cancel(Request $request)
    {
        $result = $this->paypayServices->cancelPaymentTransaction($request);
        return response()->json($result);
    }

    /**
     * Webhook paypay
     *
     * @param Request $request
     * @return void
     */
    public function webhook(Request $request)
    {
        $this->paypayServices->webhookPaymentTransaction($request);
    }
}
