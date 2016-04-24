<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePicturesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('pictures', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('post_id');
            $table->integer('picture_number');
            $table->string('picture_name');
            $table->string('picture_category');
            $table->text('picture_extension');
            $table->string('picture_tags');
            $table->date('picture_date');
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
