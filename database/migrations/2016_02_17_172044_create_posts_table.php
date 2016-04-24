<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('post_num');
            $table->string('post_name');
            $table->string('post_category');
            $table->text('post_content');
            $table->string('post_tags');
            $table->date('post_date');
            $table->string('search_query');
            $table->integer('featured_pic');
            $table->string('featured_filename');
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
