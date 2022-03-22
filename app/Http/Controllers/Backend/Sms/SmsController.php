<?php

namespace App\Http\Controllers\Backend\Sms;

use Auth;
use App\Http\Controllers\Controller;

class SmsController extends Controller
{
    public function index(){
        return view('sms.index');
    }
}
