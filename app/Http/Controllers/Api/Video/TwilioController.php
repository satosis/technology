<?php

namespace App\Http\Controllers\Api\Video;

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

    public function token(Request $request)
    {
        return $this->twilioServices->tokenVideo();
    }
}
