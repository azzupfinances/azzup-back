<?php

declare(strict_types=1);

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

// Brazilian number with area code: 10 digits (landline) or 11 digits starting with 9 (mobile).
class Phone implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value) || preg_match('/^[1-9]{2}9?\d{8}$/', $value) !== 1) {
            $fail('The :attribute must be a valid Brazilian phone number with area code.');
        }
    }
}
