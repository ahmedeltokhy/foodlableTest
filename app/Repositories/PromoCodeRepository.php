<?php

namespace App\Repositories;

use App\Http\Requests\CreatePromoCodeRequest;
use App\Models\PromoCode;
use Illuminate\Database\Eloquent\Model;

class PromoCodeRepository extends BaseRepository
{
    public function __construct(PromoCode $model)
    {
        parent::__construct($model);
    }

    public function create($data): Model
    {
        $promocode = parent::create($data);
        $promocode->allowedUsers()->sync($data['users']);
        return $promocode;
    }
}