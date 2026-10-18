<?php

declare(strict_types=1);

namespace App\Services\Transactions;

use App\Models\Transaction;

class DeleteTransactionService
{
    public function execute(Transaction $transaction): void
    {
        $transaction->delete();
    }
}
