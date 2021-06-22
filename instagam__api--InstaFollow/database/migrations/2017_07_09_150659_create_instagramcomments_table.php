<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstagramcommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instagramcomments', function (Blueprint $table) {
            $table->increments('id');
            $table->text('comment');
            $table->timestamps();
        });

        // Insert some default stuff
        DB::table('instagramcomments')->insert([
            ['comment' => 'Nice!'],
            ['comment' => '#awesome :)'],
            ['comment' => 'Like it!'],
            ['comment' => 'Boom! Great stuff!'],
            ['comment' => 'Very cool...'],
            ['comment' => '#Epic.'],
            ['comment' => '#Boom!'],
            ['comment' => 'Super cool.'],
            ['comment' => 'Great stuff.'],
            ['comment' => 'Like this!'],
            ['comment' => 'Great post.'],
            ['comment' => 'Awesome post!'],
            ['comment' => '#Inspiring!'],
            ['comment' => 'Totally cool.'],
            ['comment' => 'Superb.'],
            ['comment' => 'marvelous!'],
            ['comment' => 'Excellent!'],
            ['comment' => 'Top stuff.'],
            ['comment' => 'Man, this is very cool.'],
            ['comment' => 'Badass.'],
            ['comment' => 'Love it.'],
            ['comment' => 'So cool.'],
            ['comment' => 'Very inspirational!'],
            ['comment' => '+1!'],
            ['comment' => 'Plus 1!'],
            ['comment' => '150% Awesome.'],
            ['comment' => 'More of this!'],
            ['comment' => 'Post of the day!'],
            ['comment' => 'Perfect.'],
            ['comment' => 'Very nice...'],
            ['comment' => 'To be honest, this is post of the day!'],
            ['comment' => 'So much win!'],
            ['comment' => 'Totally badass.'],
            ['comment' => '#Winning!'],
            ['comment' => 'Great post today!'],
            ['comment' => 'Monumentally awesome. Great post!'],
            ['comment' => 'Sweet!'],
            ['comment' => 'Diggin this!'],
            ['comment' => 'Love this post. Keep em coming...'],
            ['comment' => 'Keep it up!'],
            ['comment' => 'Wow.'],
            ['comment' => 'Your feed is pretty damn cool.'],
            ['comment' => 'Dope!'],
            ['comment' => 'Liking the posts!'],
            ['comment' => 'Sensational.'],
            ['comment' => 'Whoa.'],
            ['comment' => 'This is so great!']
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instagramcomments');
    }
}




