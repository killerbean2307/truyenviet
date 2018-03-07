<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    protected $table = 'chapter';

    public function story()
    {
    	return $this->belongsTo('App\Story','story_id','id');
    }
}
