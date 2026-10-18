<?php

declare(strict_types=1);

namespace App\Http\Controllers\CreditCards;

use App\Http\Controllers\Controller;
use App\Models\CreditCard;
use App\Services\CreditCards\DeleteCreditCardService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class DeleteCreditCardController extends Controller
{
    public function __invoke(CreditCard $creditCard, DeleteCreditCardService $service): Response
    {
        Gate::authorize('delete', $creditCard);

        $service->execute($creditCard);

        return response()->noContent();
    }
}
