<?php

declare(strict_types=1);

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transactions\StoreTransactionRequest;
use App\Services\Transactions\CreateTransactionService;
use Illuminate\Http\JsonResponse;

class StoreTransactionController extends Controller
{
    public function __invoke(StoreTransactionRequest $request, CreateTransactionService $service): JsonResponse
    {
        return response()->json([
            'data' => $service->execute($request->user(), $request->validated()),
        ], 201);
    }
}
