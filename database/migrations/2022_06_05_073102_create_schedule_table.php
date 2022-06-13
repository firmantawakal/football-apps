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
        Schema::create('schedule', function (Blueprint $table) {
            $table->id();
            $table->integer('id_season');
            $table->integer('id_club_a');
            $table->integer('id_club_b');
            $table->integer('score_a')->default(0);
            $table->integer('score_b')->default(0);
            $table->integer('point_a')->default(0);
            $table->integer('point_b')->default(0);
            $table->integer('id_stadium')->nullable();
            $table->boolean('isFinish')->default(0);
            $table->dateTime('time');
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
        Schema::dropIfExists('schedule');
    }
};
