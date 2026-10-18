<?php

declare(strict_types=1);

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShowProfileController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        return response()->json(['data' => $request->user()]);
    }
}
