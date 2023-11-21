<?php

namespace App\Http\Middleware;

use App\Exceptions\AppError;
use Closure;
use Illuminate\Http\Request;

class TransactionMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->id == $request->payee){
            throw new AppError('Invalid transaction', 400);
        }

        return $next($request);
    }
}
