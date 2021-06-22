<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('max_seq_follows')->default(3);
            $table->smallInteger('max_seq_likes')->default(3);
            $table->smallInteger('max_seq_comments')->default(3);
            $table->smallInteger('max_seq_unfollows')->default(3);
            $table->smallInteger('max_daily_process')->default(500);
            $table->smallInteger('api_pause')->default(11);
            $table->timestamps();
        });

        // Insert some stuff
        DB::table('settings')->insert([
            [
                'max_seq_follows' => 3,
                'max_seq_likes' => 3,
                'max_seq_comments' => 3,
                'max_seq_unfollows' => 3,
                'max_daily_process' => 400,
                'api_pause' => 3
            ]
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
