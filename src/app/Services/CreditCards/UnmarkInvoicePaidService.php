<?php

declare(strict_types=1);

namespace App\Services\CreditCards;

use App\Models\CreditCard;

class UnmarkInvoicePaidService
{
    public function execute(CreditCard $creditCard, string $month): void
    {
        $creditCard->invoicePayments()->where('month', $month)->delete();
    }
}
