<?php

use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::middleware('jwt.verify')->group(function()
{
    Route::middleware('payee.verify')->post('/transactions',  [TransactionController::class, 'create']);
});
