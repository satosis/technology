<?php

namespace App\Http\Controllers\Api\Sms;

use Illuminate\Http\Request;
use App\Services\VonageServices;
use App\Http\Controllers\Controller;

class VonageController extends Controller
{
    protected $vonageServices;
    public function __construct(VonageServices $vonageServices)
    {
        $this->vonageServices  = $vonageServices;
    } 

    public function send(Request $request)
    { 
        $result = $this->vonageServices->send($request->phone, $request->text);
        return $result;
    }
}
