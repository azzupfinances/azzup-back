<?php

declare(strict_types=1);

namespace App\Http\Controllers\CreditCards;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreditCards\StoreCreditCardRequest;
use App\Services\CreditCards\CreateCreditCardService;
use Illuminate\Http\JsonResponse;

class StoreCreditCardController extends Controller
{
    public function __invoke(StoreCreditCardRequest $request, CreateCreditCardService $service): JsonResponse
    {
        return response()->json([
            'data' => $service->execute($request->user(), $request->validated()),
        ], 201);
    }
}
