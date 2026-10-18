<?php

declare(strict_types=1);

namespace App\Http\Controllers\CardPurchases;

use App\Http\Controllers\Controller;
use App\Services\CardPurchases\ListCardPurchasesService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

// Not paginated: clients derive every installment from the purchases (docs/business/credit-cards.md).
class ListCardPurchasesController extends Controller
{
    public function __invoke(Request $request, ListCardPurchasesService $service): JsonResponse
    {
        return response()->json([
            'data' => $service->execute($request->user()),
        ]);
    }
}
