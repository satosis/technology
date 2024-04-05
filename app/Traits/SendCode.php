<?php
 namespace App\Traits;
 use Nexmo\Laravel\Facade\Nexmo;
 class SendCode{
     public static function SendCode($phone, $text){
         Nexmo::message()->send([
             'to' => '+84'.(int)$phone,
             'from' =>'Insta',
             'text' => $text
         ]);
         return 1;
     }
 }