<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Refno');
            $table->string('Billno')->nullable();
            $table->string('Shipno');
            $table->date('RefDate')->nullable();
            $table->string('DebitAccountNo')->nullable();
            $table->string('DebitAccountName')->nullable();
            $table->string('BranchName')->nullable();
            $table->string('Amount')->nullable();
            $table->string('DebitCurrency')->nullable();
            $table->string('AccountType')->nullable();
            $table->string('TicketType')->nullable();
            $table->string('CreditAccountNo')->nullable();
            $table->string('CreditAccountName')->nullable();
            $table->double('CreditAmount')->nullable();
            $table->string('ServiceAccountNo')->nullable();
            $table->string('ServiceAccountName')->nullable();
            $table->double('ServiceAmount')->nullable();
            $table->string('ExAccountNo')->nullable();
            $table->string('ExAccountName')->nullable();
            $table->double('ExAmount')->nullable();
            $table->double('ExRate')->nullable();
            $table->double('LocalEtb')->nullable();
            $table->double('TotalEtb')->nullable();
            $table->double('TotalUsd')->nullable();
            $table->text('transactioncode')->nullable();
            $table->string('user_id')->nullable();
            $table->string('ticket_status')->nullable();
            $table->text('narration')->nullable();
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
        Schema::dropIfExists('ticket');
    }
}
