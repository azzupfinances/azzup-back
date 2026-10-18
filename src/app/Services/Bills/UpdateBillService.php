<?php

declare(strict_types=1);

namespace App\Services\Bills;

use App\Models\Bill;

class UpdateBillService
{
    /**
     * @param  array{name: string, category: string, amount_cents: int, due_day: int}  $data
     */
    public function execute(Bill $bill, array $data): Bill
    {
        $bill->update($data);

        return $bill;
    }
}
