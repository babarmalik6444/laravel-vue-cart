<?php

namespace App\Domain\Auth\Contracts;

use App\Domain\User\Models\User;

interface AuthManagementInterface
{
    public function login(string $email, string $password, bool $remember): User;

    public function logout(): void;
}
