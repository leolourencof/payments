<?php

namespace App\Http\Services;

use App\Exceptions\AppError;
use App\Models\{Transaction, User};

class TransactionService
{
    public function create(array $data)
    {
        $userPayer = $this->findUser($data['payer']);

        if($userPayer->type == 'SELLER') {
            throw new AppError('Invalid user type', 403);
        }

        if($userPayer->balance < $data['value']) {
            throw new AppError('Insufficient balance for transaction', 400);
        }

        $userPayee = $this->findUser($data['payee']);

        $userPayer->balance -= $data['value'];
        $userPayee->balance += $data['value'];

        $userPayer->save();
        $userPayee->save();
       
        return Transaction::create([
            'value' =>  $data['value'],
            'payer_id' => $userPayer->id,
            'payee_id' => $userPayee->id,
        ]);
    }

    private function findUser(string $id) {
        $userFound = User::find($id);

        if(is_null($userFound)) {
            throw new AppError("User $id not found", 404);
        }

        return $userFound;
    }
}
