<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Receivable;
use App\Models\User;

// Users only reach their own receivables; see docs/business/data-ownership.md.
class ReceivablePolicy
{
    public function update(User $user, Receivable $receivable): bool
    {
        return $receivable->user_id === $user->id;
    }

    public function delete(User $user, Receivable $receivable): bool
    {
        return $receivable->user_id === $user->id;
    }
}
