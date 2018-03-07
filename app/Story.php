<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    protected $table = 'story';

    public function chapter()
    {
    	return $this->hasMany('App\Chapter','story_id','id');
    }

    public function author()
    {
    	return $this->belongsTo('App\Author','author_id','id');
    }

    public function category()
    {
    	return $this->belongsTo('App\Category','category_id','id');
    }
}
