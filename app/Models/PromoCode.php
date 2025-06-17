<?php

namespace App\Models;

use App\PromoCodeTypesEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PromoCode extends Model
{
    protected $fillable = ['type', 'value', 'code', 'expires_at', 'max_usage', 'max_user_usage'];
    protected $casts = ['type' => PromoCodeTypesEnum::class];

    public function allowedUsers()
    {
        return $this->belongsToMany(User::class, 'promo_code_allowed_users', 'promo_code_id', 'user_id')
            ->withTimestamps();
    }

    public function usedUsers()
    {
        return $this->belongsToMany(User::class, 'promo_code_usages', 'promo_code_id', 'user_id')->withTimestamps();
    }

}