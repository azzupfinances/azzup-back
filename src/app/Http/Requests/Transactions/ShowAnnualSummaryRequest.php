<?php

declare(strict_types=1);

namespace App\Http\Requests\Transactions;

use Illuminate\Foundation\Http\FormRequest;

class ShowAnnualSummaryRequest extends FormRequest
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
            'year' => ['required', 'integer', 'between:2000,2100'],
        ];
    }
}
