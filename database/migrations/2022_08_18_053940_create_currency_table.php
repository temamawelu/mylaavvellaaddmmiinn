<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrencyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currency', function (Blueprint $table) {
            $table->increments('id');
            $table->string('currencyname')->nullable();
            $table->string('buyingrate')->nullable();
            $table->string('sellindrate')->nullable();
            $table->string('exchangecommissionrate')->nullable();
            $table->string('exchangecommission')->nullable();
            $table->string('accountname')->nullable();
            $table->string('accountno')->nullable();
            $table->string('ticketheader')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currency');
    }
}
