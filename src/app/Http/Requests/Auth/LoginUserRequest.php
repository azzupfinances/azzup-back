<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest
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
            'cpf' => ['required', 'string'],
            'password' => ['required', 'string'],
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
        if (is_string($this->input('cpf'))) {
            $this->merge(['cpf' => preg_replace('/\D/', '', $this->input('cpf'))]);
        }
    }
}
