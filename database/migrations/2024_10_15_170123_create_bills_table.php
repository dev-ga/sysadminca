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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('description');
            $table->string('payment_method');
            $table->string('reference')->default('N/A');
            $table->decimal('usd', 8, 2)->nullable()->default(0.00);
            $table->decimal('bsd', 8, 2)->nullable()->default(0.00);
            $table->string('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
