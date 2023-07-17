<?php

namespace App\Domain\User\Contracts;

interface UserManagementInterface
{
    public function registerUser(string $name, string $email, string $password);
}
