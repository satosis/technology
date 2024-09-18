<?php

namespace App\Services;

use App\Models\Payment as Pay;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VnpayServices
{
    public function vnpayTransaction(Request $request)
    {
        $code = 'VNPAY-'. strtoupper(Str::random(10));
        $vnp_TmnCode = Config::get('env.vnpay.code'); //Mã website tại VNPAY
        $vnp_HashSecret = Config::get('env.vnpay.secret'); //Chuỗi bí mật
        $vnp_Url = Config::get('env.vnpay.url');
        $vnp_Returnurl = Config::get('env.vnpay.callback');
        $vnp_TxnRef = $code; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = "Thanh toán hóa đơn phí dich vụ";
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $request->amount * 100;
        $vnp_Locale = 'vn';
        $vnp_IpAddr = request()->ip();
        $startTime = date("YmdHis");
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_ExpireDate"=> date('YmdHis',strtotime('+15 minutes',strtotime($startTime)))
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        Pay::create([
            'name' => "Thanh toán hóa đơn phí dich vụ",
            'money' => $request->amount,
            'gate' => 'vnpay',
            'status' => 0,
            'code' => $code
        ]);
        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        return $vnp_Url;
    }

    public function callback(Request $request)
    {
        $apiUrl = "https://sandbox.vnpayment.vn/merchant_webapi/api/transaction";
        $vnp_TmnCode = Config::get('env.vnpay.code'); //Mã website tại VNPAY
        $vnp_TransactionDate = $request->vnp_PayDate; // Thời gian ghi nhận giao dịch
        $vnp_HashSecret = Config::get('env.vnpay.secret'); //Chuỗi bí mật
        $vnp_RequestId = rand(1,10000); // Mã truy vấn
        $vnp_Command = "querydr"; // Mã api
        $vnp_TxnRef = $request->vnp_TxnRef; // Mã tham chiếu của giao dịch
        $vnp_OrderInfo = "Query transaction"; // Mô tả thông tin
        //$vnp_TransactionNo= ; // Tuỳ chọn, Mã giao dịch thanh toán của CTT VNPAY
        $vnp_CreateDate = date('YmdHis'); // Thời gian phát sinh request
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR']; // Địa chỉ IP của máy chủ thực hiện gọi API


        $datarq = array(
            "vnp_RequestId" => $vnp_RequestId,
            "vnp_Version" => "2.1.0",
            "vnp_Command" => $vnp_Command,
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            //$vnp_TransactionNo= ;
            "vnp_TransactionDate" => $vnp_TransactionDate,
            "vnp_CreateDate" => $vnp_CreateDate,
            "vnp_IpAddr" => $vnp_IpAddr
        );

        $format = '%s|%s|%s|%s|%s|%s|%s|%s|%s';

        $dataHash = sprintf(
            $format,
            $datarq['vnp_RequestId'], //1
            $datarq['vnp_Version'], //2
            $datarq['vnp_Command'], //3
            $datarq['vnp_TmnCode'], //4
            $datarq['vnp_TxnRef'], //5
            $datarq['vnp_TransactionDate'], //6
            $datarq['vnp_CreateDate'], //7
            $datarq['vnp_IpAddr'], //8
            $datarq['vnp_OrderInfo']//9
        );

        $checksum = hash_hmac('SHA512', $dataHash, $vnp_HashSecret);
        $datarq["vnp_SecureHash"] = $checksum;
        $txnData = $this->callAPI_auth("POST", $apiUrl, json_encode($datarq));
        $ispTxn = json_decode($txnData, true);
        $pay = Pay::where('code', $request->vnp_TxnRef)->first();
        if ($pay) {
            if($ispTxn['vnp_ResponseCode'] == "00") {
                $pay->status = 1;
            } else {
                $pay->status = 2;
            }
            $pay->update();
        }
        return redirect()->to('/payment/vnpay');
    }

    public function callAPI_auth($method, $url, $data) {
        $curl = curl_init();
        switch ($method) {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }
        // OPTIONS:
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json'
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        // EXECUTE:
        $result = curl_exec($curl);
        if (!$result) {
            die("Connection Failure");
        }
        curl_close($curl);
        return $result;
    }
}
