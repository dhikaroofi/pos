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
        Schema::create('detail_stock_opname', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stock_opname_id');
            $table->foreignId('product_id');
            $table->string('unit');
            $table->enum('stock_type', ['buy','expired','broken'])->nullable();
            $table->integer('stock')->default(0);
            $table->integer('price')->default(0);
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
