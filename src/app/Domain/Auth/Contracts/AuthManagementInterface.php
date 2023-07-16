<?php

namespace App\Domain\Auth\Contracts;

interface AuthManagementInterface
{
    public function login($email, $password, $remember);
    public function logout();
}
