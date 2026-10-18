<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\TransactionCategory;
use Database\Factories\CardPurchaseFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

// Installments are derived from these fields; see docs/business/credit-cards.md.
#[Fillable(['credit_card_id', 'description', 'category', 'total_cents', 'installments_count', 'purchase_date'])]
class CardPurchase extends Model
{
    /** @use HasFactory<CardPurchaseFactory> */
    use HasFactory;

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'category' => TransactionCategory::class,
            'total_cents' => 'integer',
            'installments_count' => 'integer',
            'purchase_date' => 'date:Y-m-d',
        ];
    }

    /**
     * @return BelongsTo<CreditCard, $this>
     */
    public function creditCard(): BelongsTo
    {
        return $this->belongsTo(CreditCard::class);
    }
}
