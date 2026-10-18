<?php

declare(strict_types=1);

namespace Tests\Feature\Receivables;

use App\Models\Receivable;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UnmarkReceivableReceivedTest extends TestCase
{
    use RefreshDatabase;

    public function test_unmarks_only_that_month(): void
    {
        $user = User::factory()->create();
        $record = Receivable::factory()->for($user)->create();
        $record->receipts()->createMany([['month' => '2026-09'], ['month' => '2026-10']]);
        Sanctum::actingAs($user);

        $this->deleteJson("/api/receivables/{$record->id}/received-months/2026-10")->assertNoContent();
        $this->deleteJson("/api/receivables/{$record->id}/received-months/2026-10")->assertNoContent();

        $this->assertSame(['2026-09'], $record->fresh()->received_months);
    }

    public function test_forbids_another_users_receivable(): void
    {
        $record = Receivable::factory()->create();
        $record->receipts()->create(['month' => '2026-10']);
        Sanctum::actingAs(User::factory()->create());

        $this->deleteJson("/api/receivables/{$record->id}/received-months/2026-10")->assertForbidden();

        $this->assertDatabaseCount('receivable_receipts', 1);
    }

    public function test_requires_authentication(): void
    {
        $record = Receivable::factory()->create();

        $this->deleteJson("/api/receivables/{$record->id}/received-months/2026-10")->assertUnauthorized();
    }
}
