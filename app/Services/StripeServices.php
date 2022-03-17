<?php

namespace App\Services;

use Config;
use Stripe\Stripe;
use Stripe\Customer;
class StripeServices
{
    public function __construct()
    { 
       Stripe::setApiKey(Config::get('env.stripe_api_key'));
       Customer::create(array(
        "description" => "Customer for truongbt",
        "source" => "tok_xxx" // token mà bạn nhận được từ client
      ));
    }  

   /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Cashier::ignoreMigrations();
    }
}
