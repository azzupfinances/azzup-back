<?php

declare(strict_types=1);

namespace App\Http\Controllers\Receivables;

use App\Http\Controllers\Controller;
use App\Models\Receivable;
use App\Services\Receivables\MarkReceivableReceivedService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class MarkReceivableReceivedController extends Controller
{
    public function __invoke(Receivable $receivable, string $month, MarkReceivableReceivedService $service): Response
    {
        Gate::authorize('update', $receivable);

        $service->execute($receivable, $month);

        return response()->noContent();
    }
}
