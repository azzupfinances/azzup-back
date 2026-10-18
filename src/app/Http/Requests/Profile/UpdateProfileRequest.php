<?php

declare(strict_types=1);

namespace App\Http\Requests\Profile;

use App\Rules\Phone;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

// Partial update: the front end saves each profile block (personal data, salary) on its own.
class UpdateProfileRequest extends FormRequest
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
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'email' => ['sometimes', 'required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($this->user())],
            'phone' => ['sometimes', 'required', 'string', new Phone],
            'salary_payment_day' => ['sometimes', 'required', 'integer', 'between:1,31'],
            'gross_salary_cents' => ['sometimes', 'required', 'integer', 'min:1', 'max:4294967295'],
        ];
    }

    protected function prepareForValidation(): void
    {
        if (is_string($this->input('phone'))) {
            $this->merge(['phone' => preg_replace('/\D/', '', $this->input('phone'))]);
        }

        if (is_string($this->input('email'))) {
            $this->merge(['email' => mb_strtolower(trim($this->input('email')))]);
        }
    }
}
