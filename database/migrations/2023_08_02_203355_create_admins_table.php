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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 25);
            $table->string('last_name', 25);
            $table->string('username', 50)->unique();
            $table->string('password', 150);
            $table->rememberToken();
            $table->timestamps();
        });

        // Set the starting value for the ID column to 2100
        if (config('database.default') === 'mysql') {
            DB::statement('ALTER TABLE admins AUTO_INCREMENT = 2100;');
        } elseif (config('database.default') === 'pgsql') {
            DB::statement('ALTER SEQUENCE admins_id_seq RESTART WITH 2100;');
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
};
