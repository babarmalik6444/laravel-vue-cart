<?php

namespace App\Http\Controllers\Api\V1;

use App\Domain\Auth\Requests\LoginRequest;
use App\Domain\Auth\Contracts\AuthManagementInterface;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private $authManagement;

    public function __construct(AuthManagementInterface $authManagement)
    {
        $this->authManagement = $authManagement;
    }

    final public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        $authenticated = $this->authManagement->login($credentials['email'], $credentials['password'], $remember);
        if ($authenticated) {
            return response()->json(['message' => 'Login successful', 'user' => $authenticated]);
        }

        return response()->json(['message' => 'Invalid Credentials'], 401);
    }

    final public function logout()
    {
        $this->authManagement->logout();
        return response()->json(['message' => 'Logout successful']);
    }
}
