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
        Schema::create('pre_billings', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('inventory_id');
            $table->string('code');
            $table->integer('quantity');
            $table->decimal('price', 10, 2)->default(0.00);
            $table->decimal('total_usd', 10, 2)->default(0.00);
            $table->decimal('total_bsd', 10, 2)->default(0.00);
            $table->string('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pre_billings');
    }
};
