<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Services\Auth\RegisterUserService;
use Illuminate\Http\JsonResponse;

class RegisterUserController extends Controller
{
    public function __invoke(RegisterUserRequest $request, RegisterUserService $service): JsonResponse
    {
        return response()->json([
            'data' => $service->execute($request->validated()),
            'message' => 'User registered successfully.',
        ], 201);
    }
}
