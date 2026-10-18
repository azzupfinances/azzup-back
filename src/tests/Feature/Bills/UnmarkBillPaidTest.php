<?php

declare(strict_types=1);

namespace Tests\Feature\Bills;

use App\Models\Bill;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UnmarkBillPaidTest extends TestCase
{
    use RefreshDatabase;

    public function test_unmarks_only_that_month(): void
    {
        $user = User::factory()->create();
        $record = Bill::factory()->for($user)->create();
        $record->payments()->createMany([['month' => '2026-09'], ['month' => '2026-10']]);
        Sanctum::actingAs($user);

        $this->deleteJson("/api/bills/{$record->id}/paid-months/2026-10")->assertNoContent();
        $this->deleteJson("/api/bills/{$record->id}/paid-months/2026-10")->assertNoContent();

        $this->assertSame(['2026-09'], $record->fresh()->paid_months);
    }

    public function test_forbids_another_users_bill(): void
    {
        $record = Bill::factory()->create();
        $record->payments()->create(['month' => '2026-10']);
        Sanctum::actingAs(User::factory()->create());

        $this->deleteJson("/api/bills/{$record->id}/paid-months/2026-10")->assertForbidden();

        $this->assertDatabaseCount('bill_payments', 1);
    }

    public function test_requires_authentication(): void
    {
        $record = Bill::factory()->create();

        $this->deleteJson("/api/bills/{$record->id}/paid-months/2026-10")->assertUnauthorized();
    }
}
