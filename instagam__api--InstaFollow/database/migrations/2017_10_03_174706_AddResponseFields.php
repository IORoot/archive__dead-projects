<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddResponseFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('instagramtaggers', function (Blueprint $table) {
            $table->text('followResponse')->nullable();
            $table->text('unfollowResponse')->nullable();
            $table->text('likeResponse')->nullable();
            $table->text('commentResponse')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('instagramtaggers', function (Blueprint $table) {
            $table->dropColumn('followResponse');
            $table->dropColumn('unfollowResponse');
            $table->dropColumn('likeResponse');
            $table->dropColumn('commentResponse');
        });
    }
}
