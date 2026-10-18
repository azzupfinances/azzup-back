<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\TransactionCategory;
use Database\Factories\BillFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

// A fixed monthly bill; its status per month is derived (docs/business/bills.md).
#[Fillable(['name', 'category', 'amount_cents', 'due_day'])]
#[Hidden(['user_id', 'payments'])]
class Bill extends Model
{
    /** @use HasFactory<BillFactory> */
    use HasFactory;

    /**
     * Clients only need the paid months, not the payment records.
     *
     * @var list<string>
     */
    protected $appends = ['paid_months'];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'category' => TransactionCategory::class,
            'amount_cents' => 'integer',
            'due_day' => 'integer',
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
     * @return HasMany<BillPayment, $this>
     */
    public function payments(): HasMany
    {
        return $this->hasMany(BillPayment::class);
    }

    /**
     * @return Attribute<list<string>, never>
     */
    protected function paidMonths(): Attribute
    {
        return Attribute::get(fn (): array => $this->payments->pluck('month')->sort()->values()->all());
    }
}
