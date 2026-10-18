<?php

declare(strict_types=1);

namespace Tests\Feature\CreditCards;

use App\Models\CardPurchase;
use App\Models\CreditCard;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class DeleteCreditCardTest extends TestCase
{
    use RefreshDatabase;

    public function test_deletes_the_card_with_its_purchases_and_payments(): void
    {
        $user = User::factory()->create();
        $creditCard = CreditCard::factory()->for($user)->create();
        $purchase = CardPurchase::factory()->for($creditCard)->create();
        $creditCard->invoicePayments()->create(['month' => '2026-10']);
        Sanctum::actingAs($user);

        $this->deleteJson("/api/credit-cards/{$creditCard->id}")->assertNoContent();

        $this->assertModelMissing($creditCard);
        $this->assertModelMissing($purchase);
        $this->assertDatabaseCount('credit_card_invoice_payments', 0);
    }

    public function test_forbids_another_users_card(): void
    {
        $creditCard = CreditCard::factory()->create();
        Sanctum::actingAs(User::factory()->create());

        $this->deleteJson("/api/credit-cards/{$creditCard->id}")->assertForbidden();

        $this->assertModelExists($creditCard);
    }

    public function test_requires_authentication(): void
    {
        $creditCard = CreditCard::factory()->create();

        $this->deleteJson("/api/credit-cards/{$creditCard->id}")->assertUnauthorized();
    }
}
