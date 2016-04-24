<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Videos extends Model
{
    //
    //The database table used by this module
    protected $table = 'videos';

    protected $fillable = ['user_id', 'video_name', 'video_text', 'video_extension', 'video_category', 'video_true_name', 'search_query'];
}
