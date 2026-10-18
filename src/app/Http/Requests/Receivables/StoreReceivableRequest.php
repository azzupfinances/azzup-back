<?php

declare(strict_types=1);

namespace App\Http\Requests\Receivables;

use Illuminate\Foundation\Http\FormRequest;

class StoreReceivableRequest extends FormRequest
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
            'description' => ['required', 'string', 'max:255'],
            'payer_name' => ['required', 'string', 'max:255'],
            'total_cents' => ['required', 'integer', 'min:1', 'max:99999999999'],
            'installments_count' => ['required', 'integer', 'between:1,24'],
            'first_due_date' => ['required', 'date_format:Y-m-d'],
        ];
    }

    protected function prepareForValidation(): void
    {
        foreach (['description', 'payer_name'] as $field) {
            if (is_string($this->input($field))) {
                $this->merge([$field => trim($this->input($field))]);
            }
        }
    }
}
