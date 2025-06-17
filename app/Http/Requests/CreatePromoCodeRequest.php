<?php

namespace App\Http\Requests;

use App\Traits\ResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CreatePromoCodeRequest extends FormRequest
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
            'type' => ['required', 'in:1,2'],
            'value' => ['required'],
            'code' => ['nullable', 'unique:promo_codes,code'],
            'expires_at' => ['required', 'date'],
            'max_usage' => ['nullable'],
            'max_user_usage' => ['nullable'],
            'users' => ['required', 'array'],
            'users.*' => ['required', 'exists:users,id'],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        return $this->ResponseFL($validator->errors(), 404);
    }
}
