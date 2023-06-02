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
        Schema::table('product', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories');
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('detail_transaction', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('product');
            $table->foreign('transaction_id')->references('id')->on('transactions');
        });

        Schema::table('stock_opname', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('detail_stock_opname', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('product');
            $table->foreign('stock_opname_id')->references('id')->on('stock_opname');
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
