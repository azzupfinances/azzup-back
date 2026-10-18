<?php

declare(strict_types=1);

namespace App\Services\Bills;

use App\Models\Bill;
use App\Models\User;
use Illuminate\Support\Collection;

class ListBillsService
{
    /**
     * @return Collection<int, Bill>
     */
    public function execute(User $user): Collection
    {
        return $user->bills()->with('payments')->orderBy('id')->get();
    }
}
