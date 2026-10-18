<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('credit_card_invoice_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('credit_card_id')->constrained()->cascadeOnDelete();
            // YYYY-MM of the paid invoice.
            $table->char('month', 7);
            $table->timestamps();

            $table->unique(['credit_card_id', 'month']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credit_card_invoice_payments');
    }
};
