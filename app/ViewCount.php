<?php

namespace App;

use App\Story;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;

class ViewCount extends Model
{
    protected $table = 'view_count';

    public function story()
    {
        return $this->belongsTo('App\Story','story_id');
    }
}
