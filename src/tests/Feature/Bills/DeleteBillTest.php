<?php

declare(strict_types=1);

namespace Tests\Feature\Bills;

use App\Models\Bill;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class DeleteBillTest extends TestCase
{
    use RefreshDatabase;

    public function test_deletes_the_bill_with_its_months(): void
    {
        $user = User::factory()->create();
        $record = Bill::factory()->for($user)->create();
        $record->payments()->create(['month' => '2026-10']);
        Sanctum::actingAs($user);

        $this->deleteJson("/api/bills/{$record->id}")->assertNoContent();

        $this->assertModelMissing($record);
        $this->assertDatabaseCount('bill_payments', 0);
    }

    public function test_forbids_another_users_bill(): void
    {
        $record = Bill::factory()->create();
        Sanctum::actingAs(User::factory()->create());

        $this->deleteJson("/api/bills/{$record->id}")->assertForbidden();

        $this->assertModelExists($record);
    }

    public function test_requires_authentication(): void
    {
        $record = Bill::factory()->create();

        $this->deleteJson("/api/bills/{$record->id}")->assertUnauthorized();
    }
}
