<?php

declare(strict_types=1);

namespace App\Services\Receivables;

use App\Models\Receivable;
use App\Models\User;
use Illuminate\Support\Collection;

class ListReceivablesService
{
    /**
     * @return Collection<int, Receivable>
     */
    public function execute(User $user): Collection
    {
        return $user->receivables()->with('receipts')->orderBy('id')->get();
    }
}
