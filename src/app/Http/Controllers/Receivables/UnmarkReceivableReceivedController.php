<?php

declare(strict_types=1);

namespace App\Http\Controllers\Receivables;

use App\Http\Controllers\Controller;
use App\Models\Receivable;
use App\Services\Receivables\UnmarkReceivableReceivedService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class UnmarkReceivableReceivedController extends Controller
{
    public function __invoke(Receivable $receivable, string $month, UnmarkReceivableReceivedService $service): Response
    {
        Gate::authorize('update', $receivable);

        $service->execute($receivable, $month);

        return response()->noContent();
    }
}
