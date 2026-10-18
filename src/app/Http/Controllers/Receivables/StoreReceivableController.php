<?php

declare(strict_types=1);

namespace App\Http\Controllers\Receivables;

use App\Http\Controllers\Controller;
use App\Http\Requests\Receivables\StoreReceivableRequest;
use App\Services\Receivables\CreateReceivableService;
use Illuminate\Http\JsonResponse;

class StoreReceivableController extends Controller
{
    public function __invoke(StoreReceivableRequest $request, CreateReceivableService $service): JsonResponse
    {
        return response()->json([
            'data' => $service->execute($request->user(), $request->validated()),
        ], 201);
    }
}
