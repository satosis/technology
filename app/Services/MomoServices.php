<?php

namespace App\Services;

use App\Models\Payment as Pay;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MomoServices
{

    function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    public function momoTransaction(Request $request)
    {
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
        $partnerCode = Config::get('env.momo.partner_code');
        $accessKey = Config::get('env.momo.access_key');
        $secretKey = Config::get('env.momo.secret_key');
        $orderId = 'SA'. strtoupper(Str::random(10));
        $orderInfo = "Thanh toán qua MoMo";
        $amount = $request->amount;
        $ipnUrl = Config::get('env.momo.callback_url');
        $redirectUrl = Config::get('env.momo.callback_url');
        $extraData = "";
        $requestId = time() . "";
        $requestType = "payWithATM";
        //before sign HMAC SHA256 signature
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $data = array('partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature);
        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);

        Pay::create([
            'name' => "Thanh toán qua MoMo",
            'money' => $amount,
            'gate' => 'momo',
            'status' => 0,
            'code' => $orderId
        ]);
        return $jsonResult['payUrl'];
    }

    public function callback(Request $request)
    {
        $orderId = $request->orderId;
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/query";
        $partnerCode = Config::get('env.momo.partner_code');
        $accessKey = Config::get('env.momo.access_key');
        $secretKey = Config::get('env.momo.secret_key');
        $requestId = time()."";


        //before sign HMAC SHA256 signature
        $rawHash = "accessKey=".$accessKey."&orderId=".$orderId."&partnerCode=".$partnerCode."&requestId=".$requestId;
        // echo "<script>console.log('Debug Objects: " . $rawHash . "' );</script>";

        $signature = hash_hmac("sha256", $rawHash, $secretKey);

        $data = array('partnerCode' => $partnerCode,
            'requestId' => $requestId,
            'orderId' => $orderId,
            'requestType' => "payWithATM",
            'signature' => $signature,
            'lang' => 'vi');
        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);  // decode json
        $resultCode = $jsonResult['resultCode'];

        $pay = Pay::where('code', $request->orderId)->first();
        if ($pay) {
            if($resultCode == 0) {
                $pay->status = 1;
            } else {
                $pay->status = 2;
            }
            $pay->update();
        }
        return redirect()->to('/payment/momo');
    }
}
