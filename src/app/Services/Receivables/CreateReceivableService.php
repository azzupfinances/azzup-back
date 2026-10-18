<?php

declare(strict_types=1);

namespace App\Services\Receivables;

use App\Models\Receivable;
use App\Models\User;

class CreateReceivableService
{
    /**
     * @param  array{description: string, payer_name: string, total_cents: int, installments_count: int, first_due_date: string}  $data
     */
    public function execute(User $user, array $data): Receivable
    {
        return $user->receivables()->create($data);
    }
}
