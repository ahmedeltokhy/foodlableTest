<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckPromoCodeRequest;
use App\Http\Requests\CreatePromoCodeRequest;
use App\Services\PromoCodeService;

class PromoCodeController extends Controller
{

    public function create(CreatePromoCodeRequest $request, PromoCodeService $promoCodeService)
    {
        $promo_code = $promoCodeService->create($request->validated());
        return $this->ResponseFL($promo_code);
    }

    public function check(CheckPromoCodeRequest $request, PromoCodeService $promoCodeService)
    {
        $promo_code_check = $promoCodeService->checkPromoCode($request);
        return $this->ResponseFL($promo_code_check);
    }
}
