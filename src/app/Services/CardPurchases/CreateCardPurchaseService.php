<?php

declare(strict_types=1);

namespace App\Services\CardPurchases;

use App\Models\CardPurchase;

class CreateCardPurchaseService
{
    /**
     * The request already checked that the card belongs to the user.
     *
     * @param  array{credit_card_id: int, description: string, category: string, total_cents: int, installments_count: int, purchase_date: string}  $data
     */
    public function execute(array $data): CardPurchase
    {
        return CardPurchase::create($data);
    }
}
