<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Bank;
use Database\Factories\CreditCardFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'bank', 'limit_cents', 'due_day'])]
#[Hidden(['user_id', 'invoicePayments'])]
class CreditCard extends Model
{
    /** @use HasFactory<CreditCardFactory> */
    use HasFactory;

    /**
     * Clients only need the paid months, not the payment records.
     *
     * @var list<string>
     */
    protected $appends = ['paid_invoice_months'];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'bank' => Bank::class,
            'limit_cents' => 'integer',
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
     * @return HasMany<CardPurchase, $this>
     */
    public function purchases(): HasMany
    {
        return $this->hasMany(CardPurchase::class);
    }

    /**
     * @return HasMany<CreditCardInvoicePayment, $this>
     */
    public function invoicePayments(): HasMany
    {
        return $this->hasMany(CreditCardInvoicePayment::class);
    }

    /**
     * @return Attribute<list<string>, never>
     */
    protected function paidInvoiceMonths(): Attribute
    {
        return Attribute::get(fn (): array => $this->invoicePayments->pluck('month')->sort()->values()->all());
    }
}
