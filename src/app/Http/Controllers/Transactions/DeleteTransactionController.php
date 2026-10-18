<?php

declare(strict_types=1);

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Services\Transactions\DeleteTransactionService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class DeleteTransactionController extends Controller
{
    public function __invoke(Transaction $transaction, DeleteTransactionService $service): Response
    {
        Gate::authorize('delete', $transaction);

        $service->execute($transaction);

        return response()->noContent();
    }
}
