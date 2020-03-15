<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSymbolHoldingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('symbol_holdings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('symbol_id');
            $table->foreign('symbol_id')->references('id')->on(
                'symbols'
            )->onDelete('CASCADE');
            $table->string('holding_name', 100);
            $table->unsignedBigInteger('shares');
            $table->double('weight', 6, 3);
            $table->unique(['symbol_id', 'holding_name']);
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
        Schema::dropIfExists('symbol_holdings');
    }
}
