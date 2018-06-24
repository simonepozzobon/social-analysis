<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMentionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mentions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('screen_name');
            $table->timestamps();
        });

        Schema::create('mentionables', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mention_id')->unsigned();
            $table->morphs('mentionable');
            $table->timestamps();

            $table->foreign('mention_id')->references('id')->on('mentions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mentions');
        Schema::dropIfExists('mentionables');
    }
}
