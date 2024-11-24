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
        Schema::create('pre_rosters', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->decimal('discount_usd', 8, 2)->default(0.00);
            $table->decimal('discount_bsd', 8, 2)->default(0.00);
            $table->decimal('bond_usd', 8, 2)->default(0.00);
            $table->decimal('bond_bsd', 8, 2)->default(0.00);
            $table->string('date_execution');
            $table->string('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pre_rosters');
    }
};
