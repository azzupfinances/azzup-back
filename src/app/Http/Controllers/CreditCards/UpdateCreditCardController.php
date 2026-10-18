<?php

declare(strict_types=1);

namespace App\Http\Controllers\CreditCards;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreditCards\UpdateCreditCardRequest;
use App\Models\CreditCard;
use App\Services\CreditCards\UpdateCreditCardService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

class UpdateCreditCardController extends Controller
{
    public function __invoke(
        UpdateCreditCardRequest $request,
        CreditCard $creditCard,
        UpdateCreditCardService $service,
    ): JsonResponse {
        Gate::authorize('update', $creditCard);

        return response()->json([
            'data' => $service->execute($creditCard, $request->validated()),
        ]);
    }
}
