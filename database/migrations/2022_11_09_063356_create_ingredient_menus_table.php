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
        Schema::create('ingredient_menu', function (Blueprint $table) {
            $table->id();
            $table->float('quantity');
            $table->foreignId('ingredient_id')
                ->nullable()
                ->references('id')
                ->on('ingredients')
                ->nullOnDelete();
            $table->foreignId('menu_id')
                ->references('id')
                ->on('menus')
                ->cascadeOnDelete();
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
        Schema::dropIfExists('ingredient_menus');
    }
};