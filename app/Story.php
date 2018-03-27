<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Story extends Model
{    
    use Sluggable;
    use SluggableScopeHelpers;
        
    protected $table = 'story';
    
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
                'onUpdate' => true
            ]
        ];
    }


    public function chapter()
    {
    	return $this->hasMany('App\Chapter','story_id','id');
    }

    public function author()
    {
    	return $this->belongsTo('App\Author','author_id');
    }

    public function category()
    {
    	return $this->belongsTo('App\Category','category_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
