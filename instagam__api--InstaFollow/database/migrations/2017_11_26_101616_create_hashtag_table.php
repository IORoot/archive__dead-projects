<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHashtagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hashtags', function (Blueprint $table) {
            $table->increments('id');
            $table->text('value');
            $table->timestamps();
        });

        // Insert some default stuff
        DB::table('hashtags')->insert([
            ['value' => 'parkour'],
            ['value' => 'freerunning'],
            ['value' => 'freerun'],
            ['value' => 'crossfit'],
            ['value' => 'fitfam'],
            ['value' => 'muscleup'],
            ['value' => 'weightlifting'],
            ['value' => 'health']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hashtags');
    }
}
