<?php

namespace App\Http\Controllers\Api\Payment;

use App\Http\Controllers\Controller;
use App\Services\MomoServices;
use Illuminate\Http\Request;

class MomoController extends Controller
{
    protected $momoServices;

    public function __construct(MomoServices $momoServices)
    {
        $this->momoServices = $momoServices;
    }

    public function momo(Request $request)
    {
        return $this->momoServices->momoTransaction($request);
    }

    public function callback(Request $request)
    {
        return $this->momoServices->callback($request);
    }
}
