<?php

declare(strict_types=1);

namespace App\Services\CreditCards;

use App\Models\CreditCard;

class DeleteCreditCardService
{
    // Purchases and invoice payments go with the card (foreign keys cascade).
    public function execute(CreditCard $creditCard): void
    {
        $creditCard->delete();
    }
}
