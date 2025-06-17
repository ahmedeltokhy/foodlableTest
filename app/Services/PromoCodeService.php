<?php

namespace App\Services;


use App\Http\Requests\CheckPromoCodeRequest;
use App\Models\PromoCode;
use App\PromoCodeTypesEnum;
use App\Repositories\BaseRepository;
use App\Repositories\PromoCodeRepository;
use Illuminate\Support\Facades\Cache;

class PromoCodeService extends BaseService
{
    public function __construct(PromoCodeRepository $repo)
    {
        parent::__construct($repo);
    }

    public function checkPromoCode(CheckPromoCodeRequest $request)
    {
        $promo_code = Cache::remember('PROMO_'.$request->promo_code, now()->addMinutes(10), function () use ($request) {
            return $this->repo->findBy(['code' => $request->promo_code]);
        });
        $user = auth()->user();
        $promo_code->usedUsers()->attach($user);
        return $this->calculateDiscount($promo_code, $request->price);
    }

    private function calculateDiscount(PromoCode $promo_code, $price)
    {
        $discounted_amount = match ($promo_code->type) {
            PromoCodeTypesEnum::PERCENTAGE => round($promo_code->value / 100, 2) * $price,
            PromoCodeTypesEnum::VALUE => $promo_code->value
        };
        return [
            "price" => $price,
            "promocode_discounted_amount" => $discounted_amount,
            "final_price" => $price - $discounted_amount
        ];
    }
}