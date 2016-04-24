<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    //
    protected $table = 'posts';

    protected $fillable = ['user_id', 'post_num','post_tags', 'post_content', 
    						'post_category', 'post_name', 'search_query', 'post_date'];
}
