<?php

declare(strict_types=1);

namespace Tests\Feature\Receivables;

use App\Models\Receivable;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class DeleteReceivableTest extends TestCase
{
    use RefreshDatabase;

    public function test_deletes_the_receivable_with_its_months(): void
    {
        $user = User::factory()->create();
        $record = Receivable::factory()->for($user)->create();
        $record->receipts()->create(['month' => '2026-10']);
        Sanctum::actingAs($user);

        $this->deleteJson("/api/receivables/{$record->id}")->assertNoContent();

        $this->assertModelMissing($record);
        $this->assertDatabaseCount('receivable_receipts', 0);
    }

    public function test_forbids_another_users_receivable(): void
    {
        $record = Receivable::factory()->create();
        Sanctum::actingAs(User::factory()->create());

        $this->deleteJson("/api/receivables/{$record->id}")->assertForbidden();

        $this->assertModelExists($record);
    }

    public function test_requires_authentication(): void
    {
        $record = Receivable::factory()->create();

        $this->deleteJson("/api/receivables/{$record->id}")->assertUnauthorized();
    }
}
