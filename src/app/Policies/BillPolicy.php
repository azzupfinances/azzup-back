<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Bill;
use App\Models\User;

// Users only reach their own bills; see docs/business/data-ownership.md.
class BillPolicy
{
    public function update(User $user, Bill $bill): bool
    {
        return $bill->user_id === $user->id;
    }

    public function delete(User $user, Bill $bill): bool
    {
        return $bill->user_id === $user->id;
    }
}
