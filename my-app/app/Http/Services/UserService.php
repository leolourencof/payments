<?php

namespace App\Http\Services;

use App\Exceptions\AppError;
use App\Models\User;

class UserService
{
    public function create(array $data)
    {
        $userFound = User::firstWhere('email', $data['email']);

        if(!is_null($userFound)) {
            throw new AppError('Email already exists', 409);
        }

        $userFound = User::firstWhere('cpf', $data['cpf']);

        if(!is_null($userFound)) {
            throw new AppError('CPF already exists', 409);
        }

        return User::create($data);
    }
}
