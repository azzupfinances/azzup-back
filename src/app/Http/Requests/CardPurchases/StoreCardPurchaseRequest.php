<?php

declare(strict_types=1);

namespace App\Http\Requests\CardPurchases;

use App\Enums\TransactionCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCardPurchaseRequest extends FormRequest
{
    private const MAX_INSTALLMENTS_COUNT = 24;

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
            // Only the user's own cards: a client-provided id never reaches another user's data.
            'credit_card_id' => [
                'required',
                'integer',
                Rule::exists('credit_cards', 'id')->where('user_id', $this->user()->id),
            ],
            'description' => ['required', 'string', 'max:255'],
            'category' => ['required', Rule::enum(TransactionCategory::class)],
            'total_cents' => ['required', 'integer', 'min:1', 'max:99999999999'],
            'installments_count' => ['required', 'integer', 'between:1,'.self::MAX_INSTALLMENTS_COUNT],
            'purchase_date' => ['required', 'date_format:Y-m-d'],
        ];
    }

    protected function prepareForValidation(): void
    {
        if (is_string($this->input('description'))) {
            $this->merge(['description' => trim($this->input('description'))]);
        }
    }
}
