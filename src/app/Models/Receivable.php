<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\ReceivableFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

// Installments are derived from these fields (docs/business/receivables.md).
#[Fillable(['description', 'payer_name', 'total_cents', 'installments_count', 'first_due_date'])]
#[Hidden(['user_id', 'receipts'])]
class Receivable extends Model
{
    /** @use HasFactory<ReceivableFactory> */
    use HasFactory;

    /**
     * Clients only need the received months, not the receipt records.
     *
     * @var list<string>
     */
    protected $appends = ['received_months'];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'total_cents' => 'integer',
            'installments_count' => 'integer',
            'first_due_date' => 'date:Y-m-d',
        ];
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany<ReceivableReceipt, $this>
     */
    public function receipts(): HasMany
    {
        return $this->hasMany(ReceivableReceipt::class);
    }

    /**
     * @return Attribute<list<string>, never>
     */
    protected function receivedMonths(): Attribute
    {
        return Attribute::get(fn (): array => $this->receipts->pluck('month')->sort()->values()->all());
    }
}
