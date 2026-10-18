<?php

declare(strict_types=1);

namespace App\Http\Requests\Transactions;

use App\Enums\PaymentMethod;
use App\Enums\TransactionCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTransactionRequest extends FormRequest
{
    // Keeps amounts far from the bigint limit and from float precision in clients.
    private const MAX_ABSOLUTE_AMOUNT_CENTS = 99_999_999_999;

    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $isExpense = is_numeric($this->input('amount_cents')) && $this->input('amount_cents') < 0;

        return [
            'description' => ['required', 'string', 'max:255'],
            // Zero amounts are rejected while that decision is pending.
            'amount_cents' => [
                'required',
                'integer',
                'not_in:0',
                'between:-'.self::MAX_ABSOLUTE_AMOUNT_CENTS.','.self::MAX_ABSOLUTE_AMOUNT_CENTS,
            ],
            'transaction_date' => ['required', 'date_format:Y-m-d'],
            'category' => ['required', Rule::enum(TransactionCategory::class)],
            // Expenses say how they were paid; income has no payment method.
            'payment_method' => $isExpense
                ? ['required', Rule::enum(PaymentMethod::class)]
                : ['prohibited'],
        ];
    }

    protected function prepareForValidation(): void
    {
        if (is_string($this->input('description'))) {
            $this->merge(['description' => trim($this->input('description'))]);
        }
    }
}
