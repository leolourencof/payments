<?php

namespace App\Http\Controllers;

use App\Http\Requests\{CreateTransactionRequest};
use App\Http\Services\TransactionService;

class TransactionController extends Controller
{
    public function create(CreateTransactionRequest $request)
    {
        $createTransactionService = new TransactionService();

        return $createTransactionService->create($request->all());
    }
}
