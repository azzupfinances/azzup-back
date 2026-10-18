<?php

declare(strict_types=1);

namespace App\Services\Receivables;

use App\Models\Receivable;

class UpdateReceivableService
{
    /**
     * @param  array{description: string, payer_name: string, total_cents: int, installments_count: int, first_due_date: string}  $data
     */
    public function execute(Receivable $receivable, array $data): Receivable
    {
        $receivable->update($data);

        return $receivable;
    }
}
