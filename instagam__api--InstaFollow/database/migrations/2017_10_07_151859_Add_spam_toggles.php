<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSpamToggles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('instagramcurrentusers', function (Blueprint $table) {
            $table->integer('followSpam')->default(0);
            $table->integer('unfollowSpam')->default(0);
            $table->integer('likeSpam')->default(0);
            $table->integer('commentSpam')->default(0);
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
            $table->dropColumn('followSpam');
            $table->dropColumn('unfollowSpam');
            $table->dropColumn('likeSpam');
            $table->dropColumn('commentSpam');
        });
    }
}
