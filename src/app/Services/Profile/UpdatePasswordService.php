<?php

declare(strict_types=1);

namespace App\Services\Profile;

use App\Models\User;
use Laravel\Sanctum\PersonalAccessToken;

class UpdatePasswordService
{
    public function execute(User $user, string $password): void
    {
        $user->update(['password' => $password]);

        // Signs out every other device; the session that changed the password stays.
        $currentToken = $user->currentAccessToken();

        $user->tokens()
            ->when(
                $currentToken instanceof PersonalAccessToken,
                fn ($query) => $query->whereKeyNot($currentToken->getKey()),
            )
            ->delete();
    }
}
