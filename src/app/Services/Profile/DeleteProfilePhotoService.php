<?php

declare(strict_types=1);

namespace App\Services\Profile;

use App\Models\User;
use Illuminate\Contracts\Filesystem\Factory as FilesystemFactory;

class DeleteProfilePhotoService
{
    private const DISK = 'local';

    public function __construct(private readonly FilesystemFactory $storage) {}

    public function execute(User $user): void
    {
        if ($user->photo_path === null) {
            return;
        }

        $this->storage->disk(self::DISK)->delete($user->photo_path);
        $user->forceFill(['photo_path' => null])->save();
    }
}
