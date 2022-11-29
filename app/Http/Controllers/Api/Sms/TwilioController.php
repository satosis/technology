<?php

namespace App\Http\Controllers\Api\Sms;

use App\Http\Controllers\Controller;
use App\Services\TwilioServices;
use Illuminate\Http\Request;

class TwilioController extends Controller
{
    protected $twilioServices;

    public function __construct(TwilioServices $twilioServices)
    {
        $this->twilioServices = $twilioServices;
    }

    public function send(Request $request)
    {
        return $this->twilioServices->sendSms($request->phone, $request->text);
    }
}
