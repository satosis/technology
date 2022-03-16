<?php

namespace App\Http\Controllers\Backend\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaypayController extends Controller
{
    public function index(){
        return view('paypay.index');
    }
}
