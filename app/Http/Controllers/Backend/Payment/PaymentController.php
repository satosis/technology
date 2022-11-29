<?php

namespace App\Http\Controllers\Backend\Payment;

use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function index()
    {
        return view('payment.index');
    }
}
