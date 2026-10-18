<?php

use App\Http\Controllers\CardPurchases\ListCardPurchasesController;
use App\Http\Controllers\CardPurchases\StoreCardPurchaseController;
use Illuminate\Support\Facades\Route;

Route::prefix('card-purchases')->name('card-purchases.')->middleware('auth:sanctum')->group(function (): void {
    Route::get('/', ListCardPurchasesController::class)->name('list');
    Route::post('/', StoreCardPurchaseController::class)->name('store');
});
