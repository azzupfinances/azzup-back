<?php

declare(strict_types=1);

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transactions\UpdateTransactionRequest;
use App\Models\Transaction;
use App\Services\Transactions\UpdateTransactionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

class UpdateTransactionController extends Controller
{
    public function __invoke(
        UpdateTransactionRequest $request,
        Transaction $transaction,
        UpdateTransactionService $service,
    ): JsonResponse {
        Gate::authorize('update', $transaction);

        return response()->json([
            'data' => $service->execute($transaction, $request->validated()),
        ]);
    }
}
