<?php

namespace App\Services;

use Log;
use Config;
use Stripe\Stripe;
use Stripe\Customer;
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
    public function webhookPaymentTransaction($request){
      Log::info($request->all());
    }
}
