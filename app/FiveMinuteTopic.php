<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FiveMinuteTopic extends Model
{
    //The database table used by this module
    protected $table = '5_minute_topics';

    protected $fillable = ['user_id', 'topic_number','topic_tags', 'topic_text', 
    						'topic_category', 'topic_name', 'search_query', 'topic_date'];

}
