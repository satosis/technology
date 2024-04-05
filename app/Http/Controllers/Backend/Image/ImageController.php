<?php

namespace App\Http\Controllers\Backend\Image;

use App\Http\Controllers\Controller;

class ImageController extends Controller
{
    public function index()
    {
        return view('image.index');
    }
}
