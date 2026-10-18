<?php

declare(strict_types=1);

namespace App\Services\Receivables;

use App\Models\Receivable;

class DeleteReceivableService
{
    // Its received months go with it (foreign key cascades).
    public function execute(Receivable $receivable): void
    {
        $receivable->delete();
    }
}
