<?php

declare(strict_types=1);

namespace App\Services\Transactions;

use App\Enums\TransactionOrigin;
use App\Models\Transaction;
use App\Models\User;

class CreateTransactionService
{
    /**
     * @param  array{description: string, amount_cents: int, transaction_date: string, category: string, payment_method?: string}  $data
     */
    public function execute(User $user, array $data): Transaction
    {
        // Refreshed so the response has every column, e.g. a null payment method on income.
        return $user->transactions()->create([
            ...$data,
            'origin' => TransactionOrigin::Manual,
        ])->refresh();
    }
}
