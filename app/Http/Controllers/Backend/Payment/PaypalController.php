<?php

namespace App\Http\Controllers\Backend\Payment;

use App\Http\Controllers\Controller;
use App\Models\Payment;

class PaypalController extends Controller
{
    public function index()
    {
        $payment = Payment::where('gate', 'paypal')->orderBy('id', 'desc')->paginate(12);
        return view('payment.paypal.index', compact('payment'));
    }
}
