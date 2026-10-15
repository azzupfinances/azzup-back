<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\Rules\Cpf;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'cpf' => ['required', 'string', new Cpf, 'unique:users,cpf'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', Password::min(8), 'confirmed'],
            'salary_payment_day' => ['required', 'integer', 'between:1,31'],
        ];
    }

    public function attributes(): array
    {
        return [
            'cpf' => 'CPF',
        ];
    }

    protected function prepareForValidation(): void
    {
        // Clients may send formatted CPFs (000.000.000-00); only digits are stored.
        if (is_string($this->input('cpf'))) {
            $this->merge(['cpf' => preg_replace('/\D/', '', $this->input('cpf'))]);
        }

        if (is_string($this->input('email'))) {
            $this->merge(['email' => mb_strtolower(trim($this->input('email')))]);
        }
    }
}
