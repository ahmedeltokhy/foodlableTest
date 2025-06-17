<?php

namespace App\Providers;

use App\Models\PromoCode;
use App\Observers\PromoCodeObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        PromoCode::observe(PromoCodeObserver::class);
    }
}
