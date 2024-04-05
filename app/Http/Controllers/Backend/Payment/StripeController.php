<?php

namespace App\Http\Controllers\Backend\Payment;

use App\Http\Controllers\Controller;
use App\Models\Payment;

class StripeController extends Controller
{
    public function index()
    {
        $payment = Payment::where('gate', 'stripe')->orderBy('id', 'desc')->paginate(12);
        return view('payment.stripe.index', compact('payment'));
    }
}
