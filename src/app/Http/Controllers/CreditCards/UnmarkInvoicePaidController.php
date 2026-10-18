<?php

declare(strict_types=1);

namespace App\Http\Controllers\CreditCards;

use App\Http\Controllers\Controller;
use App\Models\CreditCard;
use App\Services\CreditCards\UnmarkInvoicePaidService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class UnmarkInvoicePaidController extends Controller
{
    public function __invoke(CreditCard $creditCard, string $month, UnmarkInvoicePaidService $service): Response
    {
        Gate::authorize('update', $creditCard);

        $service->execute($creditCard, $month);

        return response()->noContent();
    }
}
