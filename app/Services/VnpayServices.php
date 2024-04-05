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
        $code = 'SA'. strtoupper(Str::random(10));
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
        $code = $request->vnp_TxnRef;
        if($request->vnp_ResponseCode == "00") {
            $pay = Pay::where('code', $code)->first();
            if ($pay) {
                $pay->status = 1;
                $pay->update();
            }
        }
        return redirect()->to('/payment/vnpay');
    }
}
