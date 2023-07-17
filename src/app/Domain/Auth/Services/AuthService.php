<?php

namespace App\Domain\Auth\Services;

use App\Domain\Auth\Contracts\AuthManagementInterface;
use App\Domain\User\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

class AuthService implements AuthManagementInterface
{
    public function login(string $email, string $password, bool $remember): User
    {
        if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
            $user = Auth::user();
            $token = $user->createToken('AuthToken')->plainTextToken;
            $user->token = $token;
            return $user;
        }

        throw new AuthenticationException();
    }

    public function logout(): void
    {
        Auth::user()->currentAccessToken()->delete();
    }
}
