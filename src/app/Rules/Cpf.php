<?php

declare(strict_types=1);

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Cpf implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value) || ! self::isValid($value)) {
            $fail('The :attribute must be a valid CPF.');
        }
    }

    public static function isValid(string $cpf): bool
    {
        if (preg_match('/^\d{11}$/', $cpf) !== 1) {
            return false;
        }

        // Repeated-digit sequences pass the check-digit algorithm but are not issued CPFs.
        if (preg_match('/^(\d)\1{10}$/', $cpf) === 1) {
            return false;
        }

        foreach ([9, 10] as $length) {
            $sum = 0;

            for ($i = 0; $i < $length; $i++) {
                $sum += (int) $cpf[$i] * ($length + 1 - $i);
            }

            $checkDigit = ($sum * 10) % 11 % 10;

            if ($checkDigit !== (int) $cpf[$length]) {
                return false;
            }
        }

        return true;
    }
}
