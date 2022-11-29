<?php

namespace App\Http\Controllers\Api\Sms;

use App\Http\Controllers\Controller;
use App\Services\VonageServices;
use Illuminate\Http\Request;

class VonageController extends Controller
{
    protected $vonageServices;

    public function __construct(VonageServices $vonageServices)
    {
        $this->vonageServices = $vonageServices;
    }

    public function send(Request $request)
    {
        return $this->vonageServices->send($request->phone, $request->text);
    }
}
