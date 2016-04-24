<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('documents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('document_number');
            $table->string('document_name');
            $table->string('document_category');
            $table->string('document_text');
            $table->text('document_extension');
            $table->string('document_tags');
            $table->date('document_date');
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
