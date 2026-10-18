<?php

declare(strict_types=1);

namespace App\Http\Controllers\Bills;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Services\Bills\MarkBillPaidService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class MarkBillPaidController extends Controller
{
    public function __invoke(Bill $bill, string $month, MarkBillPaidService $service): Response
    {
        Gate::authorize('update', $bill);

        $service->execute($bill, $month);

        return response()->noContent();
    }
}
