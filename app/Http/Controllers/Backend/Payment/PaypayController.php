<?php

namespace App\Http\Controllers\Backend\Payment;

use App\Http\Controllers\Controller;
use App\Models\Payment;

class PaypayController extends Controller
{
    public function index()
    {
        $payment = Payment::where('gate', 'paypay')->orderBy('id', 'desc')->paginate(12);
        return view('payment.paypay.index', compact('payment'));
    }
}
