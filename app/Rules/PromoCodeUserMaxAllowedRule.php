<?php

namespace App\Rules;

use App\Models\PromoCode;
use App\Models\PromoCodeUsage;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class PromoCodeUserMaxAllowedRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $user = auth()->user();
        $promo_code = PromoCode::query()->where("code", $value)->first();
        $max_usage_data = DB::table("promo_code_usages")
            ->select([
                DB::raw("SUM(CASE WHEN promo_code_id = ? THEN 1 ELSE 0 END) as max_promo_code_usage_count"),
                DB::raw("SUM(CASE WHEN promo_code_id = ? AND user_id = ? THEN 1 ELSE 0 END) as max_promo_code_user_usage_count"),
            ])
            ->setBindings([
                $promo_code->id,
                $promo_code->id,
                $user->id
            ])
            ->first();
        if ($promo_code->max_usage <= (int)$max_usage_data->max_promo_code_usage_count ||
            $promo_code->max_user_usage <= (int)$max_usage_data->max_promo_code_user_usage_count) {
            $fail("Max limit reached");
        }
    }
}
