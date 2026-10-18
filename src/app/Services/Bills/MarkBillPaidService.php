<?php

declare(strict_types=1);

namespace App\Services\Bills;

use App\Models\Bill;

class MarkBillPaidService
{
    // Idempotent: marking a month again changes nothing.
    public function execute(Bill $bill, string $month): void
    {
        $bill->payments()->firstOrCreate(['month' => $month]);
    }
}
