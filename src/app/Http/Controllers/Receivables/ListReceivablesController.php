<?php

declare(strict_types=1);

namespace App\Http\Controllers\Receivables;

use App\Http\Controllers\Controller;
use App\Services\Receivables\ListReceivablesService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

// Not paginated: a user has few receivables (docs/business/receivables.md).
class ListReceivablesController extends Controller
{
    public function __invoke(Request $request, ListReceivablesService $service): JsonResponse
    {
        return response()->json([
            'data' => $service->execute($request->user()),
        ]);
    }
}
