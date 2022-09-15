<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ip');
            $table->string('port')->nullable();
            $table->string('url')->nullable();
            $table->string('username');
            $table->string('password');
            $table->string('token')->nullable();
            $table->string('apiname')->nullable();
            $table->text('description')->nullable();
            $table->string('created_by')->index()->nullable();
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
        Schema::dropIfExists('ports');
    }
}
