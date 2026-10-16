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
            // Brazilian number with area code: 10 digits (landline) or 11 digits starting with 9 (mobile).
            'phone' => ['required', 'string', 'regex:/^[1-9]{2}9?\d{8}$/'],
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

    public function messages(): array
    {
        return [
            'phone.regex' => 'The :attribute must be a valid Brazilian phone number with area code.',
        ];
    }

    protected function prepareForValidation(): void
    {
        // Clients may send formatted CPFs (000.000.000-00); only digits are stored.
        if (is_string($this->input('cpf'))) {
            $this->merge(['cpf' => preg_replace('/\D/', '', $this->input('cpf'))]);
        }

        // Clients may send formatted phones ((11) 91234-5678); only digits are stored.
        if (is_string($this->input('phone'))) {
            $this->merge(['phone' => preg_replace('/\D/', '', $this->input('phone'))]);
        }

        if (is_string($this->input('email'))) {
            $this->merge(['email' => mb_strtolower(trim($this->input('email')))]);
        }
    }
}
