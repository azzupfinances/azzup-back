<?php

declare(strict_types=1);

namespace App\Http\Controllers\CreditCards;

use App\Http\Controllers\Controller;
use App\Services\CreditCards\ListCreditCardsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

// Not paginated: a user has few cards (docs/business/credit-cards.md).
class ListCreditCardsController extends Controller
{
    public function __invoke(Request $request, ListCreditCardsService $service): JsonResponse
    {
        return response()->json([
            'data' => $service->execute($request->user()),
        ]);
    }
}
