<?php

declare(strict_types=1);

namespace App\Services\CreditCards;

use App\Models\CreditCard;
use App\Models\User;

class CreateCreditCardService
{
    /**
     * @param  array{name: string, bank: string, limit_cents: int, due_day: int}  $data
     */
    public function execute(User $user, array $data): CreditCard
    {
        return $user->creditCards()->create($data);
    }
}
