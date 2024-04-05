<?php

namespace App\Services;

use App\Models\Payment;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class StripeServices
{
    public function __construct()
    {
        Stripe::setApiKey(Config::get('env.stripe.secret_key'));
    }

    public function stripeTransaction(): ?string
    {
        $price = 200;
        $quantity = 1;
        $checkout_session = Session::create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'jpy',
                        // 'currency' => 'usd',
                        'product_data' => [
                            'name' => 'Text transfer1'
                        ],
                        'unit_amount' => $price
                    ],
                    'quantity' => $quantity,
                ],

                [
                    'price_data' => [
                        'currency' => 'jpy',
                        // 'currency' => 'usd',
                        'product_data' => [
                            'name' => 'Text transfer2'
                        ],
                        'unit_amount' => $price
                    ],
                    'quantity' => $quantity,
                ]
            ],
            'mode' => 'payment',
            'success_url' => 'http://localhost:8000/payment/stripe',
            'cancel_url' => 'http://localhost:8000/payment/stripe',
        ]);
        Payment::create([
            'name' => '123',
            'money' => $price,
            'gate' => 'stripe',
            'status' => 0,
            'code' => $checkout_session->payment_intent
        ]);
        return $checkout_session->url;
    }

    public function webhookPaymentTransaction($request)
    {
        $payload = json_decode($request->getContent(), true);
        Log::info($payload);
        if ($payload['data']['object']['object'] == 'payment_intent' && $payload['data']['object']['status'] == 'succeeded') {
            $transaction = Payment::where('code', $payload['data']['object']['id'])->first();
            $transaction->status = 1;
            $transaction->update();
        }
    }
}
