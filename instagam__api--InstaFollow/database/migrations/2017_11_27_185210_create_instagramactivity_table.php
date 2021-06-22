<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstagramactivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instagramactivity', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->text('mediapk');
            $table->text('userpk')->nullable();
            $table->text('counttype')->nullable();
            $table->text('commentpk')->nullable();
            $table->text('commenttext')->nullable();
            $table->integer('activitytimestamp')->nullable();
            $table->text('activitydate')->nullable();
            $table->text('activityday')->nullable();
            $table->integer('activityhour')->nullable();
            $table->integer('activityseconds')->nullable();
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
        Schema::dropIfExists('instagramactivity');
    }
}
