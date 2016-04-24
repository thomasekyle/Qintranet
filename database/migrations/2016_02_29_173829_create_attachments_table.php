<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('attachments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('topic_id');
            $table->integer('post_id');
            $table->integer('attachment_true_name');
            $table->string('attachment_name');
            $table->string('attachment_category');
            $table->text('attachment_extension');
            $table->string('attachment_tags');
            $table->date('attachment_date');
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
