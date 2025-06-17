<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
    if (Auth::attempt($request->only('email', 'password'))) {
        $user = Auth::user();
        $token = $user->createToken(($user->is_admin?"admin":"user"),[$user->is_admin?'*':'check-promo-code'])->plainTextToken;
        return response()->json(['token' => $token], 200);
    }
    }
}
