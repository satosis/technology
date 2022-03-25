<?php

namespace App\Http\Controllers\Api\Sms;

use Illuminate\Http\Request;
use App\Services\TwilioServices;
use App\Http\Controllers\Controller;

class TwilioController extends Controller
{
    protected $twilioServices;
    public function __construct(TwilioServices $twilioServices)
    {
        $this->twilioServices  = $twilioServices;
    } 

    public function send(Request $request)
    { 
        $result = $this->twilioServices->sendSms($request->phone, $request->text);
        return $result;
    }
}
