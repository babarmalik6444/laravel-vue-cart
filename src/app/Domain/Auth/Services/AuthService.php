<?php

namespace App\Domain\Auth\Services;

use App\Domain\Auth\Contracts\AuthManagementInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AuthService implements AuthManagementInterface
{
    public function login($email, $password, $remember)
    {
        // Calculate the expiration time for the remember token (2 weeks from now)
        $rememberExpiry = $remember ? Carbon::now()->addWeeks(2) : null;
        if (Auth::attempt(['email' => $email, 'password' => $password], $remember, $rememberExpiry)) {
            $user = Auth::user();
            $token = $user->createToken('AuthToken')->plainTextToken;
            $user->token = $token;
            return $user;
        }

        return null; // Authentication failed
    }

    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();
    }
}
