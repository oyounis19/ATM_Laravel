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
        Schema::create('users', function (Blueprint $table) {
            // $table->id();
            $table->bigInteger('ssn');
            $table->bigInteger('card_id');
            $table->string('fingerprint', 150);
            $table->string('password', 150)->nullable();// PIN
            $table->string('name', 255);
            $table->string('street', 255)->nullable();
            $table->string('area')->nullable();
            $table->string('city')->nullable();
            $table->string('email', 255);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone_num', 20);
            $table->rememberToken();
            $table->timestamps();

            $table->unique('ssn');
            $table->unique('card_id');
            $table->unique('fingerprint');
            $table->unique('email');
            $table->unique('phone_num');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
