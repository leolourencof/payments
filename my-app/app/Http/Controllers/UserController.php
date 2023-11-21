<?php

namespace App\Http\Controllers;

use App\Http\Requests\{CreateUserRequest, CreateDepositRequest};
use App\Http\Services\{UserService, DepositService};

class UserController extends Controller
{
    public function create(CreateUserRequest $request)
    {
        $createUserService = new UserService();

        return $createUserService->create($request->all());
    }

    public function deposit(CreateDepositRequest $request)
    {
       $createDepositService = new DepositService();

       return $createDepositService->create(auth()->user()->id, $request->value);
    }
}
