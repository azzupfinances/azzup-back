<?php

declare(strict_types=1);

namespace App\Services\Profile;

use App\Models\User;

class UpdateProfileService
{
    /**
     * @param  array{name?: string, email?: string, phone?: string, salary_payment_day?: int, gross_salary_cents?: int}  $data
     */
    public function execute(User $user, array $data): User
    {
        $user->update($data);

        return $user;
    }
}
