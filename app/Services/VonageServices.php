<?php

namespace App\Services;

use App\Traits\SendCode;

class VonageServices
{
    public function send($phone, $text)
    {
        $code = SendCode::SendCode($phone, $text);
        return $code;
    }
} 
    
   
 