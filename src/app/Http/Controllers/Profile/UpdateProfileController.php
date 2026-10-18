<?php

declare(strict_types=1);

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\UpdateProfileRequest;
use App\Services\Profile\UpdateProfileService;
use Illuminate\Http\JsonResponse;

class UpdateProfileController extends Controller
{
    public function __invoke(UpdateProfileRequest $request, UpdateProfileService $service): JsonResponse
    {
        return response()->json([
            'data' => $service->execute($request->user(), $request->validated()),
        ]);
    }
}
