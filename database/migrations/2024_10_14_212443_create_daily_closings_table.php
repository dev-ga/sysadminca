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
        Schema::create('daily_closings', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('ref_debito')->nullable();
            $table->string('ref_credito')->nullable();
            $table->string('ref_visaMaster')->nullable();
            $table->decimal('amount_debito',8, 2)->default(0.00);
            $table->decimal('amount_credito',8, 2)->default(0.00);
            $table->decimal('amount_visaMaster',8, 2)->default(0.00);
            $table->decimal('total_efectivo_usd',8, 2)->default(0.00);
            $table->decimal('total_efectivo_bsd',8, 2)->default(0.00);
            $table->decimal('total_zelle',8, 2)->default(0.00);
            $table->decimal('total_banesco_panama',8, 2)->default(0.00);
            $table->decimal('total_pago_movil',8, 2)->default(0.00);
            $table->string('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_closings');
    }
};
