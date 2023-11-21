<?php

namespace App\Http\Services;

use App\Exceptions\AppError;

class AuthService
{
    public function login(array $data)
    {
       if(!$token = auth()->attempt($data)) {
        throw new AppError('Incorrect email or password', 401);
       }

       return response()->json(['token' => $token, 'user' => auth()->user()], 200);
    }
}
