<?php

declare(strict_types=1);

namespace App\Services\Bills;

use App\Models\Bill;

class DeleteBillService
{
    // Its paid months go with it (foreign key cascades).
    public function execute(Bill $bill): void
    {
        $bill->delete();
    }
}
