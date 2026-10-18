<?php

declare(strict_types=1);

namespace App\Http\Controllers\Receivables;

use App\Http\Controllers\Controller;
use App\Http\Requests\Receivables\UpdateReceivableRequest;
use App\Models\Receivable;
use App\Services\Receivables\UpdateReceivableService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

class UpdateReceivableController extends Controller
{
    public function __invoke(UpdateReceivableRequest $request, Receivable $receivable, UpdateReceivableService $service): JsonResponse
    {
        Gate::authorize('update', $receivable);

        return response()->json([
            'data' => $service->execute($receivable, $request->validated()),
        ]);
    }
}
