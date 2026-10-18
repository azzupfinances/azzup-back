<?php

declare(strict_types=1);

namespace App\Http\Controllers\Bills;

use App\Http\Controllers\Controller;
use App\Http\Requests\Bills\UpdateBillRequest;
use App\Models\Bill;
use App\Services\Bills\UpdateBillService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

class UpdateBillController extends Controller
{
    public function __invoke(UpdateBillRequest $request, Bill $bill, UpdateBillService $service): JsonResponse
    {
        Gate::authorize('update', $bill);

        return response()->json([
            'data' => $service->execute($bill, $request->validated()),
        ]);
    }
}
