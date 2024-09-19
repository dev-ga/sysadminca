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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->string('sku');
            $table->string('code');
            $table->string('product');
            $table->string('category');
            $table->string('subcategory');
            $table->string('size');
            $table->string('color');
            $table->string('model')->nullable();
            $table->string('material')->nullable();
            $table->string('variation_1')->nullable();
            $table->string('variation_2')->nullable();
            $table->string('variation_3')->nullable();
            $table->string('variation_4')->nullable();
            $table->string('variation_5')->nullable();
            $table->string('date');
            $table->decimal('price', 10, 2)->default(0.00);
            $table->integer('quantity');
            $table->string('image')->nullable();
            $table->string('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
