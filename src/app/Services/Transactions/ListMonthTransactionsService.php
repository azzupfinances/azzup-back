<?php

declare(strict_types=1);

namespace App\Services\Transactions;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class ListMonthTransactionsService
{
    /**
     * @param  string  $month  YYYY-MM
     * @return Collection<int, Transaction>
     */
    public function execute(User $user, string $month): Collection
    {
        $monthStart = Carbon::createFromFormat('!Y-m', $month);

        return $user->transactions()
            ->whereBetween('transaction_date', [
                $monthStart->toDateString(),
                $monthStart->copy()->endOfMonth()->toDateString(),
            ])
            ->orderByDesc('transaction_date')
            ->orderByDesc('id')
            ->get();
    }
}
