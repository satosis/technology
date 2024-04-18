<?php

namespace App\Http\Controllers\Backend\Ads;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
class AdsController extends Controller
{
    public function index()
    {
        return view('ads.index');
    }
}
