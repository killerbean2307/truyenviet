<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $table = 'author';

    public function story()
    {
    	return $this->hasMany('App\Story','author_id','id');
    }

    public static function getAll()
    {
    	return Author::all();
    }

    public static function luu($data)
    {
    	return Author::crete([
    		'name' => $data->name,
    	]);
    }

    public static function sua($id, $data)
    {
    	$author = Author::find($id);
        $author->name = $data['name'];
        $author->status = $data['status'];

        return $author->save();
    }

    public static function xoa($id)
    {
        $author = Author::find($id);
        $author->delete();
    }

    public static function xoaNhieu($id)
    {
        $author = Author::whereIn('id',$id);
        $author->delete();
    }

}
