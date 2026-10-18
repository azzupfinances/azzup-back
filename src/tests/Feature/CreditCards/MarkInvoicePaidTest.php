<?php

declare(strict_types=1);

namespace Tests\Feature\CreditCards;

use App\Models\CreditCard;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class MarkInvoicePaidTest extends TestCase
{
    use RefreshDatabase;

    public function test_marks_the_month_as_paid_once(): void
    {
        $user = User::factory()->create();
        $creditCard = CreditCard::factory()->for($user)->create();
        Sanctum::actingAs($user);

        $this->putJson("/api/credit-cards/{$creditCard->id}/paid-invoices/2026-10")->assertNoContent();
        $this->putJson("/api/credit-cards/{$creditCard->id}/paid-invoices/2026-10")->assertNoContent();

        $this->assertSame(['2026-10'], $creditCard->fresh()->paid_invoice_months);
    }

    public function test_rejects_an_invalid_month(): void
    {
        $user = User::factory()->create();
        $creditCard = CreditCard::factory()->for($user)->create();
        Sanctum::actingAs($user);

        $this->putJson("/api/credit-cards/{$creditCard->id}/paid-invoices/2026-13")->assertNotFound();
    }

    public function test_forbids_another_users_card(): void
    {
        $creditCard = CreditCard::factory()->create();
        Sanctum::actingAs(User::factory()->create());

        $this->putJson("/api/credit-cards/{$creditCard->id}/paid-invoices/2026-10")->assertForbidden();

        $this->assertDatabaseCount('credit_card_invoice_payments', 0);
    }

    public function test_requires_authentication(): void
    {
        $creditCard = CreditCard::factory()->create();

        $this->putJson("/api/credit-cards/{$creditCard->id}/paid-invoices/2026-10")->assertUnauthorized();
    }
}
