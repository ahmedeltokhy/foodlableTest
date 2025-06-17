<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PromoCodeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Http\Middleware\CheckAbilities;
Route::post('login', [AuthController::class, 'login']);
Route::prefix('promo-codes')->middleware('auth:sanctum')->group(function () {
    Route::post('create', [PromoCodeController::class, 'create'])->middleware(CheckAbilities::class.':create-promo-code');
    Route::post('check', [PromoCodeController::class, 'check'])->middleware(CheckAbilities::class.':check-promo-code') ->middleware('throttle:5,1');
});
