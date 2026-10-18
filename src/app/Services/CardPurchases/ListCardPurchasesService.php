<?php

declare(strict_types=1);

namespace App\Services\CardPurchases;

use App\Models\CardPurchase;
use App\Models\User;
use Illuminate\Support\Collection;

class ListCardPurchasesService
{
    /**
     * @return Collection<int, CardPurchase>
     */
    public function execute(User $user): Collection
    {
        return $user->cardPurchases()
            ->orderByDesc('purchase_date')
            ->orderByDesc('card_purchases.id')
            ->get()
            // The through key (credit card's user id) is not part of the purchase.
            ->each->makeHidden('laravel_through_key');
    }
}
