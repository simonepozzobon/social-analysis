<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTweetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tweets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tw_profile_id')->unsigned();
            $table->string('created_time');
            $table->string('TWid');
            $table->text('message');
            $table->integer('retweets');
            $table->integer('favorites');
            $table->timestamps();

            $table->foreign('tw_profile_id')->references('id')->on('tw_profiles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tweets');
    }
}
