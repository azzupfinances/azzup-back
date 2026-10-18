<?php

declare(strict_types=1);

namespace App\Http\Controllers\Bills;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Services\Bills\DeleteBillService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class DeleteBillController extends Controller
{
    public function __invoke(Bill $bill, DeleteBillService $service): Response
    {
        Gate::authorize('delete', $bill);

        $service->execute($bill);

        return response()->noContent();
    }
}
