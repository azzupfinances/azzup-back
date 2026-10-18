<?php

declare(strict_types=1);

namespace App\Http\Controllers\CardPurchases;

use App\Http\Controllers\Controller;
use App\Http\Requests\CardPurchases\StoreCardPurchaseRequest;
use App\Services\CardPurchases\CreateCardPurchaseService;
use Illuminate\Http\JsonResponse;

class StoreCardPurchaseController extends Controller
{
    public function __invoke(StoreCardPurchaseRequest $request, CreateCardPurchaseService $service): JsonResponse
    {
        return response()->json([
            'data' => $service->execute($request->validated()),
        ], 201);
    }
}
