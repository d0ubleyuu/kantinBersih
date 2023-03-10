<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_transaction', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_id')
                ->nullable()
                ->references('id')
                ->on('menus')
                ->nullOnDelete();
            $table->foreignId('transaction_id')
                ->references('id')
                ->on('transactions')
                ->cascadeOnDelete();
            $table->integer('amount');
            $table->bigInteger('total_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_transactions');
    }
};