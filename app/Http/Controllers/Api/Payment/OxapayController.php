<?php

namespace App\Http\Controllers\Api\Payment;

use App\Http\Controllers\Controller;
use App\Services\OxapayServices;
use Illuminate\Http\Request;

class OxapayController extends Controller
{
    protected $oxapayServices;

    public function __construct(OxapayServices $oxapayServices)
    {
        $this->oxapayServices = $oxapayServices;
    }

    public function invoice(Request $request)
    {
        return $this->oxapayServices->invoice($request);
    }

    public function callback(Request $request)
    {
        return $this->oxapayServices->callback($request);
    }
}
