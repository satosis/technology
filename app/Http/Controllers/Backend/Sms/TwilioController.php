<?php

namespace App\Http\Controllers\Backend\Sms;

use App\Http\Controllers\Controller;

class TwilioController extends Controller
{
    public function index()
    {
        return view('sms.twilio.index');
    }
}
