<?php

namespace App\Http\Controllers\Api\Chat;

use App\Http\Controllers\Controller;
use App\Services\PusherServices;
use Illuminate\Http\Request;

class PusherController extends Controller
{
    protected $pusherServices;

    public function __construct(PusherServices $pusherServices)
    {
        $this->pusherServices = $pusherServices;
    }

    public function store(Request $request)
    {
        return $this->pusherServices->store($request);
    }

    public function upload(Request $request)
    {
        return $this->pusherServices->upload($request);
    }
}
