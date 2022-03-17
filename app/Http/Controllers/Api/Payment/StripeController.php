<?php

namespace App\Http\Controllers\Api\Payment;

use Illuminate\Http\Request;
use App\Services\StripeServices;
use App\Http\Controllers\Controller;

class StripeController extends Controller
{
    protected $stripeServices;
    public function __construct(StripeServices $stripeServices)
    {
        $this->stripeServices  = $stripeServices;
    } 

    public function stripe(Request $request)
    {
        $result = $this->stripeServices->stripeTransaction($request);
        return response()->json($result);
    }
    
    public function cancel(Request $request)
    {
        $result = $this->stripeServices->cancelPaymentTransaction($request);
        return response()->json($result);
    }

    /**
     * Webhook stripe
     *
     * @param Request $request
     * @return void
     */
    public function webhook(Request $request)
    {
        $this->stripeServices->webhookPaymentTransaction($request);
    }
}
