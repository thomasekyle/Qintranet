<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    //
    protected $table = 'attachments';

    protected $fillable = ['topic_id', 'post_id', 'attachment_name','attachment_tags', 'attachment_extension', 
    						'attachment_category', 'search_query', 'attachment_date', 'attachment_true_name'];
}
