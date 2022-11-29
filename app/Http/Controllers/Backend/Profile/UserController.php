<?php

namespace App\Http\Controllers\Backend\Profile;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        return view('user.profile');
    }
}
