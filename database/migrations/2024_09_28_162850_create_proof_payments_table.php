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
        Schema::create('proof_payments', function (Blueprint $table) {
            $table->id();
            $table->string('sale_code')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('phone')->nullable();
            $table->string('reference')->nullable();
            $table->string('bank_code')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('zelle_name')->nullable();
            $table->string('zelle_email')->nullable();
            $table->string('bp_name')->nullable();
            $table->string('bp_reference')->nullable();
            $table->decimal('amount', 8, 2)->nullable();
            $table->string('image')->nullable();
            $table->string('enn_state')->nullable();
            $table->string('enn_agency')->nullable();
            $table->string('enn_code_agency')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proof_payments');
    }
};
