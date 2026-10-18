<?php

declare(strict_types=1);

namespace Tests\Feature\Transactions;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class DeleteTransactionTest extends TestCase
{
    use RefreshDatabase;

    public function test_deletes_the_transaction(): void
    {
        $user = User::factory()->create();
        $transaction = Transaction::factory()->for($user)->create();
        Sanctum::actingAs($user);

        $this->deleteJson("/api/transactions/{$transaction->id}")->assertNoContent();

        $this->assertModelMissing($transaction);
    }

    public function test_forbids_another_users_transaction(): void
    {
        $transaction = Transaction::factory()->create();
        Sanctum::actingAs(User::factory()->create());

        $this->deleteJson("/api/transactions/{$transaction->id}")->assertForbidden();

        $this->assertModelExists($transaction);
    }

    public function test_requires_authentication(): void
    {
        $transaction = Transaction::factory()->create();

        $this->deleteJson("/api/transactions/{$transaction->id}")->assertUnauthorized();
    }
}
