<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRankingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rankings', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->double('score');
            $table->integer('value');
            $table->integer('LastValue')->nullable();
            $table->integer('color');
            $table->integer('amount');
            $table->integer('ratop');
            $table->double('TPR')->nullable();
            $table->double('gamescore')->default(0);
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
        Schema::dropIfExists('ranking');
    }
}
