<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('video_number');
            $table->string('video_name');
            $table->string('video_category');
            $table->string('video_text');
            $table->text('video_extension');
            $table->string('video_tags');
            $table->date('video_date');
            $table->string('search_query');
            $table->timestamp('added_on');
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
        //
    }
}
