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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('account_id');
            $table->bigInteger('ssn');
            $table->integer('atm_id');
            $table->bigInteger('amount');
            $table->enum('state', ['denied', 'approved'])->nullable();
            $table->enum('type', ['withdraw', 'deposit', 'transfer']);
            $table->integer('receiver_id')->nullable();
            $table->timestamps();

            $table->unique('ssn');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
