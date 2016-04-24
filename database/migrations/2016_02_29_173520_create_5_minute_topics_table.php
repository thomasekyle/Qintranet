<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5MinuteTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('5_minute_topics', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('topic_number');
            $table->string('topic_name');
            $table->string('topic_category');
            $table->text('topic_text');
            $table->string('topic_tags');
            $table->date('topic_date');
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
