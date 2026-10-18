<?php

declare(strict_types=1);

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transactions\ListTransactionsRequest;
use App\Services\Transactions\ListMonthTransactionsService;
use Illuminate\Http\JsonResponse;

// Not paginated: the statement shows the whole month and its totals (docs/api/pagination.md).
class ListTransactionsController extends Controller
{
    public function __invoke(ListTransactionsRequest $request, ListMonthTransactionsService $service): JsonResponse
    {
        return response()->json([
            'data' => $service->execute($request->user(), $request->validated('month')),
        ]);
    }
}
