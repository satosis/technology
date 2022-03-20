<?php

namespace App\Http\Controllers\Api\Video;

use Illuminate\Http\Request;
use App\Services\PusherServices;
use App\Http\Controllers\Controller;

class PusherController extends Controller
{
    protected $pusherServices;
    public function __construct(PusherServices $pusherServices)
    {
        $this->pusherServices  = $pusherServices;
    } 

    public function store(Request $request){
        $chat = $this->pusherServices->store($request);
        return $chat;
    }
    public function upload(Request $request){
        $chat = $this->pusherServices->upload($request);
        return $chat;
    }
}
