<?php

declare(strict_types=1);

namespace App\Services\Transactions;

use App\Models\Transaction;

class UpdateTransactionService
{
    /**
     * The origin is kept: it records how the transaction entered the system.
     *
     * @param  array{description: string, amount_cents: int, transaction_date: string, category: string, payment_method?: string}  $data
     */
    public function execute(Transaction $transaction, array $data): Transaction
    {
        // An expense turned into income loses its payment method.
        $transaction->update([
            'payment_method' => null,
            ...$data,
        ]);

        return $transaction;
    }
}
