<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\CreditCard;
use App\Models\User;

// Users only reach their own credit cards; see docs/business/data-ownership.md.
class CreditCardPolicy
{
    public function update(User $user, CreditCard $creditCard): bool
    {
        return $creditCard->user_id === $user->id;
    }

    public function delete(User $user, CreditCard $creditCard): bool
    {
        return $creditCard->user_id === $user->id;
    }
}
