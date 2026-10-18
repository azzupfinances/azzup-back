<?php

declare(strict_types=1);

namespace App\Services\CreditCards;

use App\Models\CreditCard;
use App\Models\User;
use Illuminate\Support\Collection;

class ListCreditCardsService
{
    /**
     * @return Collection<int, CreditCard>
     */
    public function execute(User $user): Collection
    {
        return $user->creditCards()->with('invoicePayments')->orderBy('id')->get();
    }
}
