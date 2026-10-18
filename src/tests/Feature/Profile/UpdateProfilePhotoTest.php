<?php

declare(strict_types=1);

namespace Tests\Feature\Profile;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UpdateProfilePhotoTest extends TestCase
{
    use RefreshDatabase;

    // Fake files are created by size and type because the PHP image has no GD extension
    // (UploadedFile::fake()->image() needs it).

    public function test_stores_the_photo_and_replaces_the_previous_one(): void
    {
        Storage::fake('local');
        $user = User::factory()->create();
        Storage::disk('local')->put('profile-photos/old.jpg', 'old');
        $user->forceFill(['photo_path' => 'profile-photos/old.jpg'])->save();
        Sanctum::actingAs($user);

        $this->postJson('/api/profile/photo', ['photo' => UploadedFile::fake()->create('me.png', 200, 'image/png')])
            ->assertOk()
            ->assertJsonPath('data.has_photo', true);

        Storage::disk('local')->assertMissing('profile-photos/old.jpg');
        Storage::disk('local')->assertExists($user->fresh()->photo_path);
    }

    public function test_rejects_files_that_are_not_allowed_images(): void
    {
        Storage::fake('local');
        Sanctum::actingAs(User::factory()->create());

        $this->postJson('/api/profile/photo', ['photo' => UploadedFile::fake()->create('me.pdf', 100, 'application/pdf')])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['photo']);

        $this->postJson('/api/profile/photo', ['photo' => UploadedFile::fake()->create('me.jpg', 6000, 'image/jpeg')])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['photo']);
    }

    public function test_requires_authentication(): void
    {
        $this->postJson('/api/profile/photo')->assertUnauthorized();
    }
}
