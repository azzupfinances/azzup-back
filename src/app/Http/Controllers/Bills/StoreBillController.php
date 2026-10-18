<?php

declare(strict_types=1);

namespace App\Http\Controllers\Bills;

use App\Http\Controllers\Controller;
use App\Http\Requests\Bills\StoreBillRequest;
use App\Services\Bills\CreateBillService;
use Illuminate\Http\JsonResponse;

class StoreBillController extends Controller
{
    public function __invoke(StoreBillRequest $request, CreateBillService $service): JsonResponse
    {
        return response()->json([
            'data' => $service->execute($request->user(), $request->validated()),
        ], 201);
    }
}
