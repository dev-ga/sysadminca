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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('sale_code');
            $table->decimal('total_sale', 8, 2)->default(0);
            $table->string('delivery_method')->nullable();
            $table->string('payment_method')->nullable();
            $table->decimal('tasa_bcv', 8, 2)->default(0);
            $table->decimal('pay_bsd', 8, 2)->default(0);
            $table->decimal('pay_usd', 8, 2)->default(0);
            $table->string('date')->nullable();
            $table->string('type_sale');
            $table->integer('user_id')->nullable();
            $table->string('user_name')->nullable();
            $table->decimal('commission_bsd', 8, 2)->default(0);
            $table->decimal('commission_usd', 8, 2)->default(0);
            $table->integer('proof_payment_id')->nullable();
            $table->integer('status_id')->default(1);
            $table->string('qr')->nullable();
            $table->string('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
