<?php

namespace App\Http\Controllers\Backend\Login;

use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function index(){
        return view('login.index');
    }
}
