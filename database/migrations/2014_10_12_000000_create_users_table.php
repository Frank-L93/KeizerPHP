<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('password');
            $table->string('api_token')->nullable();
            $table->string('email')->unique();
            $table->integer('knsb_id');
            $table->integer('rechten')->nullable();
            $table->integer('club_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->double('rating');
            $table->integer('beschikbaar');
            $table->integer('firsttimelogin')->nullable();
            $table->integer('active')->nullable();
            $table->string('activate');
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
}
