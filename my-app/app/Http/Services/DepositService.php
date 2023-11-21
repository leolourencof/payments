<?php

namespace App\Http\Services;

use App\Exceptions\AppError;
use App\Models\User;

class DepositService
{
    public function create(string $userId, float $value)
    {
        $userFound = User::find($userId);

        if(is_null($userFound)) {
            throw new AppError('User not found', 404);
        }

        $userFound->balance += $value;
        $userFound->save();

        return $userFound;
    }
}
