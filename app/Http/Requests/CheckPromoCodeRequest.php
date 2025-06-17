<?php

namespace App\Http\Requests;

use App\Rules\PromoCodeExpiredRule;
use App\Rules\PromoCodeUserAvailableRule;
use App\Rules\PromoCodeUserMaxAllowedRule;
use App\Traits\ResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CheckPromoCodeRequest extends FormRequest
{
    use ResponseTrait;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "price" => ["required", "numeric"],
            "promo_code" => ["required", "string",
                'exists:promo_codes,code',
                new PromoCodeExpiredRule(),
                new PromoCodeUserAvailableRule(),
                new PromoCodeUserMaxAllowedRule()],
        ];
    }
    public function failedValidation(Validator $validator)
    {
        throw  new HttpResponseException($this->ResponseFL($validator->errors(), 404));
    }
}
