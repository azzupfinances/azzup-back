<?php

declare(strict_types=1);

namespace App\Services\Auth;

use App\Exceptions\InvalidCredentialsException;
use App\Models\User;
use Illuminate\Contracts\Hashing\Hasher;

class LoginUserService
{
    public function __construct(private readonly Hasher $hasher) {}

    /**
     * @return array{user: User, token: string}
     *
     * @throws InvalidCredentialsException
     */
    public function execute(string $cpf, string $password): array
    {
        $user = User::where('cpf', $cpf)->first();

        if ($user === null || ! $this->hasher->check($password, $user->password)) {
            throw new InvalidCredentialsException;
        }

        return [
            'user' => $user,
            'token' => $user->createToken('auth')->plainTextToken,
        ];
    }
}
