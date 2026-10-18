<?php

declare(strict_types=1);

namespace Tests\Feature\Bills;

use App\Models\Bill;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class MarkBillPaidTest extends TestCase
{
    use RefreshDatabase;

    public function test_marks_the_month_once(): void
    {
        $user = User::factory()->create();
        $record = Bill::factory()->for($user)->create();
        Sanctum::actingAs($user);

        $this->putJson("/api/bills/{$record->id}/paid-months/2026-10")->assertNoContent();
        $this->putJson("/api/bills/{$record->id}/paid-months/2026-10")->assertNoContent();

        $this->assertSame(['2026-10'], $record->fresh()->paid_months);
    }

    public function test_rejects_an_invalid_month(): void
    {
        $user = User::factory()->create();
        $record = Bill::factory()->for($user)->create();
        Sanctum::actingAs($user);

        $this->putJson("/api/bills/{$record->id}/paid-months/2026-1")->assertNotFound();
    }

    public function test_forbids_another_users_bill(): void
    {
        $record = Bill::factory()->create();
        Sanctum::actingAs(User::factory()->create());

        $this->putJson("/api/bills/{$record->id}/paid-months/2026-10")->assertForbidden();

        $this->assertDatabaseCount('bill_payments', 0);
    }

    public function test_requires_authentication(): void
    {
        $record = Bill::factory()->create();

        $this->putJson("/api/bills/{$record->id}/paid-months/2026-10")->assertUnauthorized();
    }
}
