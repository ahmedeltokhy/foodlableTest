<?php

namespace App\Rules;

use App\Models\PromoCode;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PromoCodeExpiredRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $promo_code = PromoCode::query()->where("code", $value)->first();
        if ($promo_code->expires_at&&Carbon::now()->greaterThan($promo_code->expires_at)) {
            $fail("Promo code expired");
        }
    }
}
