<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstagramtaggersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instagramtaggers', function (Blueprint $table) {
            $table->increments('id');
            $table->text('username');
            $table->bigInteger('tagger_pk')->unique();
            $table->bigInteger('tagger_media_pk')->nullable();
            $table->dateTime('followed')->nullable();
            $table->dateTime('unfollowed')->nullable();
            $table->dateTime('liked')->nullable();
            $table->dateTime('commented')->nullable();
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
        Schema::dropIfExists('instagramtaggers');
    }
}
