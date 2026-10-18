<?php

declare(strict_types=1);

namespace App\Services\CreditCards;

use App\Models\CreditCard;

class UpdateCreditCardService
{
    /**
     * @param  array{name: string, bank: string, limit_cents: int, due_day: int}  $data
     */
    public function execute(CreditCard $creditCard, array $data): CreditCard
    {
        $creditCard->update($data);

        return $creditCard;
    }
}
