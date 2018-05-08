<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    protected $table = 'chapter';

    public function story()
    {
    	return $this->belongsTo('App\Story');
    }

    public function user()
    {
    	return $this->belongsTo('App\User', 'user_id', 'id');
    }

    /**
     * Lấy danh sách chương mới nhất (của thể loại)
     * @param  int $category_id thể loại
     * @return list chapter              
     */
    public static function getNewestChapter($category_id = "")
    {
        $chap = Chapter::orderBy('created_at','desc');

        if($category_id != '')
        {
            $chap = $chap->whereHas('story', function($query) use ($category_id){
                $query->where('category_id', $category_id);
            });
        }
        $chap = $chap->get()->unique('story_id');

        return $chap;
    }

    /**
     * kiểm tra có phải chương mới nhất của truyện
     * @return boolean 
     */
    public function isLastestChapter()
    {
        $lastestChapter = $this->story->chapter()->orderBy('ordering','desc')->pluck('ordering')->first();

        return $this->ordering == $lastestChapter ? true : false;
    }

    /**
     * kiểm tra có phải chương đầu tiên không
     * @return boolean 
     */
    public function isFirstChapter()
    {
        $firstChapter = $this->story->chapter()->orderBy('ordering','asc')->pluck('ordering')->first();

        return $this->ordering == $firstChapter ? true : false;
    }

    /**
     * lấy chương tiếp theo
     * @return chapter 
     */
    public function getNextChapter()
    {
        if($this->isLastestChapter())
        {
            return $this;
        }
        else
        {
            return $this->story->chapter->filter(function($value, $key){
                return $value->ordering > $this->ordering;
            })->sortBy('ordering')->first();
        }
    }

    /**
     * lấy chương trước
     * @return chapter 
     */
    public function getPreviousChapter()
    {
        if($this->isFirstChapter())
        {
            return $this;
        }
        else
        {
            return $this->story->chapter->filter(function($value, $key){
                return $value->ordering < $this->ordering;
            })->sortBy('ordering')->last();
        }
    }  
}
