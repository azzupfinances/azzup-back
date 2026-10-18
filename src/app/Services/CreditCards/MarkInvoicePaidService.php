<?php

declare(strict_types=1);

namespace App\Services\CreditCards;

use App\Models\CreditCard;

class MarkInvoicePaidService
{
    // Idempotent: marking a paid month again changes nothing.
    public function execute(CreditCard $creditCard, string $month): void
    {
        $creditCard->invoicePayments()->firstOrCreate(['month' => $month]);
    }
}
