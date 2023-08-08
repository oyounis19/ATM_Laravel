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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ssn');
            $table->bigInteger('balance')->default(0);
            $table->enum('type', ['saving', 'gold', 'current'])->default('current');
            $table->enum('state', ['running', 'blocked'])->default('running');
            $table->bigInteger('num_of_withdraws')->nullable();
            $table->bigInteger('total_withdraws')->nullable();
            $table->bigInteger('num_of_transfers')->nullable();
            $table->bigInteger('total_transfers')->nullable();
            $table->timestamps();
        });

        // Set the starting value for the ID column to 1151510550
        if (config('database.default') === 'mysql') {
            DB::statement('ALTER TABLE cards AUTO_INCREMENT = 1151510550;');
        } elseif (config('database.default') === 'pgsql') {
            DB::statement('ALTER SEQUENCE cards_id_seq RESTART WITH 1151510550;');
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
};
