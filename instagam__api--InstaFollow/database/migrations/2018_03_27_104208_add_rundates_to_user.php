<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRundatesToUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('instagramcurrentusers', function (Blueprint $table) {
            $table->dateTime('last_batch_started')->nullable();
            $table->dateTime('last_batch_ended')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('instagramcurrentusers', function (Blueprint $table) {
            $table->dropColumn('last_batch_started');
            $table->dropColumn('last_batch_ended');
        });
    }
}
