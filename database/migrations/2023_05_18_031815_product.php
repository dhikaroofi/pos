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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id');
            $table->string('image');
            $table->string('barcode',75)->nullable();
            $table->string('name');
            $table->string('unit',45);
            $table->integer('stock')->default(0);
            $table->integer('selling_price')->default(0);
            $table->integer('selling_price_resellers')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
