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
        Schema::create('technicians', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 25);
            $table->string('last_name', 25);
            $table->string('username', 50)->unique();
            $table->string('password', 150);
            // $table->enum('role', ['Admin', 'Technician']);
            $table->timestamps();
        });

        // Set the starting value for the ID column to 2100
        if (config('database.default') === 'mysql') {
            DB::statement('ALTER TABLE technicians AUTO_INCREMENT = 6100;');
        } elseif (config('database.default') === 'pgsql') {
            DB::statement('ALTER SEQUENCE technicians_id_seq RESTART WITH 6100;');
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('technicians');
    }
};
