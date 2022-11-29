<?php

namespace App\Http\Controllers\Backend\Sms;

use App\Http\Controllers\Controller;
use Auth;

class SmsController extends Controller
{
    public function index()
    {
        return view('sms.index');
    }
}
