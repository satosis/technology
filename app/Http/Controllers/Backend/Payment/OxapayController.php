<?php

namespace App\Http\Controllers\Backend\Payment;

use App\Http\Controllers\Controller;
use App\Models\Payment;

class OxapayController extends Controller
{
    public function index()
    {
        $payment = Payment::where('gate', 'oxapay')->orderBy('id', 'desc')->paginate(12);
        return view('payment.oxapay.index', compact('payment'));
    }
}
