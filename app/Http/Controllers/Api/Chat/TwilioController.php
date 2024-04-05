<?php

namespace App\Http\Controllers\Api\Chat;

use App\Http\Controllers\Controller;
use App\Services\TwilioServices;
use Illuminate\Http\Request;

class TwilioController extends Controller
{
    protected $twilioServices;
    public function __construct(TwilioServices $twilioServices)
    {
        $this->twilioServices  = $twilioServices;
    } 

    public function list(Request $request, $room)
    {
        return $this->twilioServices->list($room);
    }
    

    public function token(Request $request)
    {
        return $this->twilioServices->tokenChat($request);
    }
    
    public function webhook(Request $request)
    {
        $result = $this->twilioServices->webhook($request);
        return response()->json($result);
    }

}
