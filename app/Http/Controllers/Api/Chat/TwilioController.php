<?php

namespace App\Http\Controllers\Api\Chat;

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

    public function list(Request $request, $room)
    {
        $result = $this->twilioServices->list($room);
        return $result;
    }
    

    public function token(Request $request)
    {
        $result = $this->twilioServices->tokenChat($request);
        return $result;
    }
    
    public function webhook(Request $request)
    {
        $result = $this->twilioServices->webhook($request);
        return response()->json($result);
    }

}
