<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('account_id');
            $table->bigInteger('ssn')->unique();
            $table->integer('atm_id');
            $table->bigInteger('amount');
            $table->enum('state', ['denied', 'approved'])->nullable();
            $table->enum('type', ['withdraw', 'deposit', 'transfer']);
            $table->integer('receiver_id')->nullable();
            $table->timestamps();
        });

        // Set the starting value for the ID column to 10180
        if (config('database.default') === 'mysql') {
            DB::statement('ALTER TABLE transactions AUTO_INCREMENT = 10180;');
        } elseif (config('database.default') === 'pgsql') {
            DB::statement('ALTER SEQUENCE transactions_id_seq RESTART WITH 10180;');
        }
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
