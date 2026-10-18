<?php

declare(strict_types=1);

namespace App\Services\Receivables;

use App\Models\Receivable;

class MarkReceivableReceivedService
{
    // Idempotent: marking a month again changes nothing.
    public function execute(Receivable $receivable, string $month): void
    {
        $receivable->receipts()->firstOrCreate(['month' => $month]);
    }
}
