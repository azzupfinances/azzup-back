<?php

use App\Http\Controllers\CreditCards\DeleteCreditCardController;
use App\Http\Controllers\CreditCards\ListCreditCardsController;
use App\Http\Controllers\CreditCards\MarkInvoicePaidController;
use App\Http\Controllers\CreditCards\StoreCreditCardController;
use App\Http\Controllers\CreditCards\UnmarkInvoicePaidController;
use App\Http\Controllers\CreditCards\UpdateCreditCardController;
use Illuminate\Support\Facades\Route;

Route::prefix('credit-cards')->name('credit-cards.')->middleware('auth:sanctum')->group(function (): void {
    Route::get('/', ListCreditCardsController::class)->name('list');
    Route::post('/', StoreCreditCardController::class)->name('store');
    Route::put('{creditCard}', UpdateCreditCardController::class)->name('update');
    Route::delete('{creditCard}', DeleteCreditCardController::class)->name('delete');
    Route::put('{creditCard}/paid-invoices/{month}', MarkInvoicePaidController::class)->name('mark-invoice-paid');
    Route::delete('{creditCard}/paid-invoices/{month}', UnmarkInvoicePaidController::class)->name('unmark-invoice-paid');
});
