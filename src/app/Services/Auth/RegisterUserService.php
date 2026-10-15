<?php

declare(strict_types=1);

namespace App\Services\Auth;

use App\Models\User;

class RegisterUserService
{
    /**
     * @param  array{name: string, cpf: string, email: string, password: string, salary_payment_day: int}  $data
     * @return array{user: User, token: string}
     */
    public function execute(array $data): array
    {
        $user = User::create($data);

        return [
            'user' => $user,
            'token' => $user->createToken('auth')->plainTextToken,
        ];
    }
}
