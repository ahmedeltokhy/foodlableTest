<?php

namespace App\Observers;

use App\Models\PromoCode;
use Illuminate\Support\Str;

class PromoCodeObserver
{
    public function creating(PromoCode $promoCode)
    {
        if (empty($promoCode->code)) {
            $promoCode->code = Str::random(10);
        }
    }
}
