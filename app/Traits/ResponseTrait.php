<?php

namespace App\Traits;

trait ResponseTrait
{
   public function ResponseFL($data, $code = 200)
   {
      return response()->json(['code'=>$code,'body'=>$data], $code);
   }

}