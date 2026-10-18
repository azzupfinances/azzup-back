<?php

declare(strict_types=1);

namespace Tests\Feature\Receivables;

use App\Models\Receivable;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class MarkReceivableReceivedTest extends TestCase
{
    use RefreshDatabase;

    public function test_marks_the_month_once(): void
    {
        $user = User::factory()->create();
        $record = Receivable::factory()->for($user)->create();
        Sanctum::actingAs($user);

        $this->putJson("/api/receivables/{$record->id}/received-months/2026-10")->assertNoContent();
        $this->putJson("/api/receivables/{$record->id}/received-months/2026-10")->assertNoContent();

        $this->assertSame(['2026-10'], $record->fresh()->received_months);
    }

    public function test_rejects_an_invalid_month(): void
    {
        $user = User::factory()->create();
        $record = Receivable::factory()->for($user)->create();
        Sanctum::actingAs($user);

        $this->putJson("/api/receivables/{$record->id}/received-months/2026-1")->assertNotFound();
    }

    public function test_forbids_another_users_receivable(): void
    {
        $record = Receivable::factory()->create();
        Sanctum::actingAs(User::factory()->create());

        $this->putJson("/api/receivables/{$record->id}/received-months/2026-10")->assertForbidden();

        $this->assertDatabaseCount('receivable_receipts', 0);
    }

    public function test_requires_authentication(): void
    {
        $record = Receivable::factory()->create();

        $this->putJson("/api/receivables/{$record->id}/received-months/2026-10")->assertUnauthorized();
    }
}
