<?php

namespace App\Domain\User\Services;

use App\Domain\User\Contracts\UserManagementInterface;
use App\Domain\User\Models\User;

class UserManagementService implements UserManagementInterface
{
    public function registerUser($name, $email, $password): User
    {
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
        ]);

        return $user;
    }
}
