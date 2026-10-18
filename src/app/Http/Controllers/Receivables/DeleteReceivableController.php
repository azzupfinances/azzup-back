<?php

declare(strict_types=1);

namespace App\Http\Controllers\Receivables;

use App\Http\Controllers\Controller;
use App\Models\Receivable;
use App\Services\Receivables\DeleteReceivableService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class DeleteReceivableController extends Controller
{
    public function __invoke(Receivable $receivable, DeleteReceivableService $service): Response
    {
        Gate::authorize('delete', $receivable);

        $service->execute($receivable);

        return response()->noContent();
    }
}
