<?php

declare(strict_types=1);

namespace App\Services\Bills;

use App\Models\Bill;

class UnmarkBillPaidService
{
    public function execute(Bill $bill, string $month): void
    {
        $bill->payments()->where('month', $month)->delete();
    }
}
