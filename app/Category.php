<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Story;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Category extends Model
{
    protected $table = 'category';

    use Sluggable;
    use SluggableScopeHelpers;  

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
                'onUpdate' => true
            ]
        ];
    }

    public function story()
    {
    	return $this->hasMany('App\Story','category_id','id');
    }

    public static function getAll()
    {
    	return Category::all();
    }

    public static function luu($data)
    {
        $category = new Category;
        $category->name = $data['name'];
        $category->description = $data['description'];
        $category->status = $data['status'];
        $category->created_at = $data['created_at'];
        $category->updated_at = $data['updated_at'];
        return $category->save();
    }

    public static function sua($id, $data)
    {
    	$category = Category::find($id);
        $category->name = $data['name'];
        $category->description = $data['description'];
        $category->status = $data['status'];

        return $category->save();
    }

    public static function xoa($id)
    {
        $category = Category::find($id);
        $category->delete();
    }

    public static function xoaNhieu($id)
    {
        $category = Category::whereIn('id',$id);
        $category->delete();
    }

}
