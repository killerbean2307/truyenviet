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

    public function user()
    {
    	return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public static function getNewestChapter($category_id = "", $number)
    {
        $chap = Chapter::orderBy('created_at','desc');

        if($category_id != '')
        {
            $chap = $chap->whereHas('story', function($query) use ($category_id){
                $query->where('category_id', $category_id);
            });
        }
        $chap = $chap->limit($number)->get();

        return $chap;
    }
}
