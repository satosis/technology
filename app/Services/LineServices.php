<?php

namespace App\Services;

use Log;
class LineServices
{
    public function webhook($request)
    { 
      Log::info($request->all());
      return 1;
    }   
}
