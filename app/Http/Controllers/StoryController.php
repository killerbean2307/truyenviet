<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Story;
use App\Author;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Cviebrock\EloquentSluggable\Sluggable;

class StoryController extends Controller
{
    public function index()
    {
    	$categories = Category::select('id','name')->get();
    	$authors = Author::select('id','name')->get();
    	return view('admin.story.list',compact('categories','authors'));
    }

    public function getAll()
    {
    	// $stories = DB::table('story');
    	$stories = Story::all();
        foreach($stories as $story)
        {
        	$story->category->name;
        }
        return Datatables::of($stories)->make(true);

    }

    public function store(Request $request)
    {
    	$this->validate($request,
    		[
    			'name' => 'required|min:2|max:50|unique:Story,name',
                'image' => 'mimes:jpeg,jpg,png,gif',
                ''
    		],
    		[
    			'name.required' => 'Không được để trống tên',
    			'name.min' => 'Tên giới hạn 2-50 ký tự',
    			'name.max' => 'Tên giới hạn 2-50 ký tự',
    			'name.unique' => 'Tên đã trùng',
                'image.mimes' => 'Chỉ được upload file ảnh',
    		]);
    	$author = new Author;
    	$author->name = $request->name;
        $author->detail = $request->detail;
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $tenhinh = str_random(4)."_".$name;
            while (file_exists("upload/".$tenhinh)) {
                $tenhinh = str_random(4)."_".$name;
            }
            $file->move("upload/",$tenhinh);
            $author->image = $tenhinh;
        }    
    	$author->status = 1;
        $author->created_at = Carbon::now();
        $author->updated_at = Carbon::now();

   		$author->save();
   		return response()->json($author);    	
    }
}
