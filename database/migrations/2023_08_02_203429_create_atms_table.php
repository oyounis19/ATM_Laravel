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
        Schema::create('atms', function (Blueprint $table) {
            $table->id();
            $table->string('city', 30);
            $table->string('street', 30)->nullable();
            $table->string('area', 30)->nullable();
            $table->bigInteger('balance');
            $table->timestamps();
        });
        // Set the starting value for the ID column to 1280
        if (config('database.default') === 'mysql') {
            DB::statement('ALTER TABLE cards AUTO_INCREMENT = 1280;');
        } elseif (config('database.default') === 'pgsql') {
            DB::statement('ALTER SEQUENCE cards_id_seq RESTART WITH 1280;');
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('atms');
    }
};
