<?php

namespace App\Services;

use Config;
use Log;
use Stripe\Customer;
use Stripe\Stripe;

class StripeServices
{
    public function __construct()
    {
        Stripe::setApiKey(Config::get('env.stripe.key'));
        Customer::create(array(
            "description" => "Customer for truongbt",
            "source" => "tok_1KeJ1hLxvwHioeUumJkWId5l" // token mà bạn nhận được từ client
        ));
    }

    public function webhookPaymentTransaction($request)
    {
        Log::info($request->all());
    }
}
