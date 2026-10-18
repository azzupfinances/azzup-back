<?php

declare(strict_types=1);

namespace App\Http\Controllers\CreditCards;

use App\Http\Controllers\Controller;
use App\Models\CreditCard;
use App\Services\CreditCards\MarkInvoicePaidService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class MarkInvoicePaidController extends Controller
{
    public function __invoke(CreditCard $creditCard, string $month, MarkInvoicePaidService $service): Response
    {
        Gate::authorize('update', $creditCard);

        $service->execute($creditCard, $month);

        return response()->noContent();
    }
}
