<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Services\AuthService;

class AuthController extends Controller
{
    public function login(AuthRequest $request)
    {
        $authService = new AuthService();

        return $authService->login($request->all());
    }
}
