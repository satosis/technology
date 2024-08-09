<?php

namespace App\Http\Controllers\Backend\Payment;

use App\Http\Controllers\Controller;
use App\Models\Payment;

class CoinpaymentController extends Controller
{
    public function index()
    {
        $payment = Payment::where('gate', 'coinpayment')->orderBy('id', 'desc')->paginate(12);
        return view('payment.coinpayment.index', compact('payment'));
    }
}
