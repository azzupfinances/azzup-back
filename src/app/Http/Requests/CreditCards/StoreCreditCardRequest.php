<?php

declare(strict_types=1);

namespace App\Http\Requests\CreditCards;

use App\Enums\Bank;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCreditCardRequest extends FormRequest
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
            'bank' => ['required', Rule::enum(Bank::class)],
            'limit_cents' => ['required', 'integer', 'min:1', 'max:99999999999'],
            'due_day' => ['required', 'integer', 'between:1,31'],
        ];
    }

    protected function prepareForValidation(): void
    {
        if (is_string($this->input('name'))) {
            $this->merge(['name' => trim($this->input('name'))]);
        }
    }
}
