<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    //
    //The database table used by this module
    protected $table = 'documents';

    protected $fillable = ['user_id', 'document_name', 'document_text', 'document_tags', 'document_extension', 'document_category', 'document_true_name', 'search_query'];
}
