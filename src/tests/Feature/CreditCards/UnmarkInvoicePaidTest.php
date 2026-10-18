<?php

declare(strict_types=1);

namespace Tests\Feature\CreditCards;

use App\Models\CreditCard;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UnmarkInvoicePaidTest extends TestCase
{
    use RefreshDatabase;

    public function test_unmarks_only_that_month(): void
    {
        $user = User::factory()->create();
        $creditCard = CreditCard::factory()->for($user)->create();
        $creditCard->invoicePayments()->createMany([['month' => '2026-09'], ['month' => '2026-10']]);
        Sanctum::actingAs($user);

        $this->deleteJson("/api/credit-cards/{$creditCard->id}/paid-invoices/2026-10")->assertNoContent();
        $this->deleteJson("/api/credit-cards/{$creditCard->id}/paid-invoices/2026-10")->assertNoContent();

        $this->assertSame(['2026-09'], $creditCard->fresh()->paid_invoice_months);
    }

    public function test_forbids_another_users_card(): void
    {
        $creditCard = CreditCard::factory()->create();
        $creditCard->invoicePayments()->create(['month' => '2026-10']);
        Sanctum::actingAs(User::factory()->create());

        $this->deleteJson("/api/credit-cards/{$creditCard->id}/paid-invoices/2026-10")->assertForbidden();

        $this->assertDatabaseCount('credit_card_invoice_payments', 1);
    }

    public function test_requires_authentication(): void
    {
        $creditCard = CreditCard::factory()->create();

        $this->deleteJson("/api/credit-cards/{$creditCard->id}/paid-invoices/2026-10")->assertUnauthorized();
    }
}
