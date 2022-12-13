<?php

namespace App\Services;

use App\Models\Payment;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use PayPay\OpenPaymentAPI\Client;
use PayPay\OpenPaymentAPI\Models\CreateQrCodePayload;

class PaypayServices
{
    public function __construct()
    {
        $this->client = new Client(
            [
                'API_KEY' => Config::get('env.paypay.key'),
                'API_SECRET' => Config::get('env.paypay.secret'),
                'MERCHANT_ID' => Config::get('env.paypay.merchant')
            ],
            false
        );
    }

    public function paypayTransaction($request)
    {
        $CQCPayload = new CreateQrCodePayload();
        // Set merchant pay identifier
        $CQCPayload->setMerchantPaymentId(Str::random(15));

        // Log time of request
        $CQCPayload->setRequestedAt();
        // Indicate you want QR Code
        $CQCPayload->setCodeType("ORDER_QR");

        $amount = [
            "amount" => $request->amount,
            "currency" => 'JPY'
        ];
        $CQCPayload->setAmount($amount);
        // Configure redirects
        $CQCPayload->setRedirectType('APP_DEEP_LINK');
        $CQCPayload->setRedirectUrl(Config::get('env.app_url') . '/payment');
        // Get data for QR code
        $response = $this->client->code->createQRCode($CQCPayload);

        $result = $response['data'];
        Payment::create([
            'name' => '123',
            'money' => $request->amount,
            'gate' => 'paypay',
            'status' => 0,
            'code' => $result['merchantPaymentId']
        ]);
        return $result;
    }

    public function cancelPaymentTransaction($request)
    {
        return $this->client->payment->cancelPayment(
            "Consultant-" . $request->consultant . "-Advisor-" . $request->advisor
        );
    }

    public function webhookPaymentTransaction($request)
    {
        $payload = json_decode($request->getContent(), true);
        Log::info($payload);
        if ($payload['notification_type'] == 'Transaction' && $payload['state'] == 'COMPLETED') {
            $transaction = Payment::where('code', $payload['merchant_order_id'])->first();
            $transaction->status = 1;
            $transaction->update();
        }
    }
}
