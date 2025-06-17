<?php

namespace App\Rules;

use App\Models\PromoCode;
use App\Models\PromoCodeAllowedUser;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PromoCodeUserAvailableRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $user = auth()->user();
        $promo_code = PromoCode::query()->where("code", $value)->first();
        if (!PromoCodeAllowedUser::query()->where("promo_code_id", $promo_code->id)
            ->where('user_id',$user->getAuthIdentifier())->exists()) {
            $fail("Promo code not allowed for this user");
        }
    }
}
