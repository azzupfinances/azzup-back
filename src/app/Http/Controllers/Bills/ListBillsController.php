<?php

declare(strict_types=1);

namespace App\Http\Controllers\Bills;

use App\Http\Controllers\Controller;
use App\Services\Bills\ListBillsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

// Not paginated: a user has few bills (docs/business/bills.md).
class ListBillsController extends Controller
{
    public function __invoke(Request $request, ListBillsService $service): JsonResponse
    {
        return response()->json([
            'data' => $service->execute($request->user()),
        ]);
    }
}
