<?php

declare(strict_types=1);

namespace App\Services\Bills;

use App\Models\Bill;
use App\Models\User;

class CreateBillService
{
    /**
     * @param  array{name: string, category: string, amount_cents: int, due_day: int}  $data
     */
    public function execute(User $user, array $data): Bill
    {
        return $user->bills()->create($data);
    }
}
