<?php

namespace App\Domain\User\Contracts;

interface UserManagementInterface
{
    public function registerUser($name, $email, $password);
}
