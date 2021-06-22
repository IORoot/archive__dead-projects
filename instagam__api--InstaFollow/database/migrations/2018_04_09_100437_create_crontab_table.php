<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrontabTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crontab', function (Blueprint $table) {
            $table->increments('id');
            $table->text('function');
            $table->text('timing');
            $table->text('processcount');
            $table->timestamps();
        });

        // Insert some default stuff
        DB::table('crontab')->insert([
            ['function' => 'recon', 'timing' => '0 13 * * *', 'processcount' => '0'],
            ['function' => 'process', 'timing' => '55 09 * * *', 'processcount' => '470'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crontab');
    }
}
