<?php

declare(strict_types=1);

namespace App\Services\Receivables;

use App\Models\Receivable;

class UnmarkReceivableReceivedService
{
    public function execute(Receivable $receivable, string $month): void
    {
        $receivable->receipts()->where('month', $month)->delete();
    }
}
