<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\ViewCount;
use App\Chapter;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Laravel\Scout\Searchable;

class Story extends Model
{    
    use Sluggable;
    use SluggableScopeHelpers;
    use Searchable;

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

   public function searchableAs()
   {
      return 'story_index';
   }

   public function toSearchableArray()
   {
      $array = $this->toArray();

      $array['category'] = $this->category->name;

      $array['author'] = $this->author->name;

      return $array;
   }

    public function chapter()
    {
    	return $this->hasMany('App\Chapter');
    }

    public function author()
    {
    	return $this->belongsTo('App\Author','author_id');
    }

    public function category()
    {
    	return $this->belongsTo('App\Category','category_id');
    }

    public function viewCount()
    {
        return $this->hasOne('App\ViewCount', 'story_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public static function getFullStory($category_id = null)
    {
        $story = Story::has('chapter')->where('status', 2);

        if($category_id != null){
            $story->where('category_id', $category_id);
        }

        // $story->with(['chapter' => function($query){
        //     $query->orderBy('created_at','desc');
        // } ]);
        $story->orderBy('view','desc');
        return $story->get();
    }

    public static function getNewStory($category_id = null)
    {
        $story = Story::has('chapter')->where('created_at', '>', Carbon::now()->subWeek(2));

        if($category_id != null){
            $story->where('category_id', $category_id);
        }

        $story->orderBy('updated_at','desc');

        return $story->get();
    }

    public function isFull()
    {
        return $this->status == 2 ? true : false;
    }

    public function isHot()
    {
        $view = $this->viewCount->week_view;
        if($view >= 2000)
            return true;
        return false;
    }

    public static function getHotStory($category_id = null)
    {
        $story = Story::leftJoin('view_count', 'story.id', 'view_count.story_id')->has('chapter')
                    ->orderBy('view_count.week_view','desc');
        if($category_id)
            $story->where('category_id', $category_id);
        return $story->get();
    }

    public function getLastChapter()
    {
        return $lastChapter = $this->chapter->sortBy('ordering')->last();
    }

    public function getFirstChapter()
    {
        return $firstChapter = $this->chapter->sortBy('ordering')->first();
    }

    public static function getTopViewDayStory()
    {
        $story = Story::leftJoin('view_count', 'story.id', 'view_count.story_id')->has('chapter')
                    ->orderBy('view_count.day_view','desc')->take(10);
        return $story->get();
    }

    public static function getTopViewWeekStory()
    {
        $story = Story::leftJoin('view_count', 'story.id', 'view_count.story_id')->has('chapter')
                    ->orderBy('view_count.week_view','desc')->take(10);
        return $story->get();
    }

    public static function getTopViewMonthStory()
    {
        $story = Story::leftJoin('view_count', 'story.id', 'view_count.story_id')->has('chapter')
                    ->orderBy('view_count.month_view','desc')->take(10);
        return $story->get();
    }
}
