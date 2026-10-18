<?php

declare(strict_types=1);

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\UpdateProfilePhotoRequest;
use App\Services\Profile\UpdateProfilePhotoService;
use Illuminate\Http\JsonResponse;

class UpdateProfilePhotoController extends Controller
{
    public function __invoke(UpdateProfilePhotoRequest $request, UpdateProfilePhotoService $service): JsonResponse
    {
        return response()->json([
            'data' => $service->execute($request->user(), $request->file('photo')),
        ]);
    }
}
