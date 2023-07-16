<?php

namespace App\Http\Controllers\Api\V1;

use App\Domain\User\Contracts\UserManagementInterface;
use App\Http\Controllers\Controller;
use App\Domain\User\Requests\CreateUserRequest;

class UserController extends Controller
{
    private $userManagement;

    public function __construct(UserManagementInterface $userManagement)
    {
        $this->userManagement = $userManagement;
    }

    public function store(CreateUserRequest $request)
    {
        $data = $request->validated();
        $user = $this->userManagement->registerUser($data['name'], $data['email'], $data['password']);
        return response()->json(['message' => 'Account created successfully', 'data' => $user]);
    }

}
