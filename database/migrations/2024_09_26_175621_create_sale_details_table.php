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
        Schema::create('sale_details', function (Blueprint $table) {
            $table->id();
            $table->integer('sale_id');
            $table->string('sale_code');
            $table->string('inventory_id');
            $table->string('sku');
            $table->string('inventory_code');
            $table->decimal('price', 8, 2)->default(0);
            $table->integer('quantity')->default(0);
            $table->decimal('total_pay_usd', 8, 2)->default(0);
            $table->integer('user_id');
            $table->string('date')->nullable();
            $table->integer('status_id')->default(1);
            $table->string('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_details');
    }
};
