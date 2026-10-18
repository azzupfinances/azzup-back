<?php

declare(strict_types=1);

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transactions\ShowAnnualSummaryRequest;
use App\Services\Transactions\ShowAnnualSummaryService;
use Illuminate\Http\JsonResponse;

class ShowAnnualSummaryController extends Controller
{
    public function __invoke(ShowAnnualSummaryRequest $request, ShowAnnualSummaryService $service): JsonResponse
    {
        return response()->json([
            'data' => $service->execute($request->user(), (int) $request->validated('year')),
        ]);
    }
}
