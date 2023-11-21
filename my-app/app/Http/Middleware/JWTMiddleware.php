<?php

namespace App\Http\Middleware;

use App\Exceptions\AppError;
use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        try {
            JWTAuth::parseToken()->authenticate();
            return $next($request);
        } catch (JWTException $e) {
            if($e instanceof TokenInvalidException) {
                throw new AppError('Invalid Token', 498);
            }

            if($e instanceof TokenExpiredException) {
                throw new AppError('Expired Token', 401);
            }

            throw new AppError($e->getMessage(), 501);
        }
    }
}
