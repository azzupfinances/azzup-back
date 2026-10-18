<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

#[Fillable(['name', 'cpf', 'email', 'phone', 'password', 'salary_payment_day', 'gross_salary_cents'])]
#[Hidden(['password', 'remember_token', 'photo_path'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The photo path stays internal; clients only learn whether a photo exists.
     *
     * @var list<string>
     */
    protected $appends = ['has_photo'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'salary_payment_day' => 'integer',
            'gross_salary_cents' => 'integer',
        ];
    }

    /**
     * @return Attribute<bool, never>
     */
    protected function hasPhoto(): Attribute
    {
        return Attribute::get(fn (): bool => $this->photo_path !== null);
    }

    /**
     * @return HasMany<Transaction, $this>
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * @return HasMany<CreditCard, $this>
     */
    public function creditCards(): HasMany
    {
        return $this->hasMany(CreditCard::class);
    }

    /**
     * @return HasManyThrough<CardPurchase, CreditCard, $this>
     */
    public function cardPurchases(): HasManyThrough
    {
        return $this->hasManyThrough(CardPurchase::class, CreditCard::class);
    }

    /**
     * @return HasMany<Bill, $this>
     */
    public function bills(): HasMany
    {
        return $this->hasMany(Bill::class);
    }

    /**
     * @return HasMany<Receivable, $this>
     */
    public function receivables(): HasMany
    {
        return $this->hasMany(Receivable::class);
    }
}
