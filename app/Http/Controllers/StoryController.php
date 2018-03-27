<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Story;
use App\Author;
use App\Chapter;
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
        	if($story->author)
        	{
        		$story->author->name;        		
        	}
        }
        return Datatables::of($stories)->make(true);

    }

    public function getChapterView($id)
    {
    	$story = Story::find($id);
    	$lastOrder = $story->chapter()->orderBy('ordering','desc')->pluck('ordering')->first();
    	return view('admin.chapter.list', compact('story','lastOrder'));
    }

    public function getChaptersByStoryId($id)
    {
    	$story = Story::findOrFail($id);
    	$chapters = $story->chapter()->orderBy('ordering')->get();
  		if(!empty($chapters))
  		{
    		foreach($chapters as $chapter)
    		{
    			$chapter->user->name;
    		}
    	}
    	return Datatables::of($chapters)
    		->make(true);
    }

    public function getDetail($id)
    {
    	$story = Story::findOrFail($id);
    	$story->category;
    	$story->author;
    	$story->user;
    	return response()->json($story);
    }

    public function store(Request $request)
    {
    	$this->validate($request,
    		[
    			'name' => 'required|min:2|max:50|',
                'image' => 'mimes:jpeg,jpg,png,gif',
    		],
    		[
    			'name.required' => 'Không được để trống tên',
    			'name.min' => 'Tên giới hạn 2-50 ký tự',
    			'name.max' => 'Tên giới hạn 2-50 ký tự',
    			'name.unique' => 'Tên đã trùng',
                'image.mimes' => 'Chỉ được upload file ảnh',
    		]);
    	$story = new Story;
    	$story->name = $request->name;
        $story->description = $request->description;
        $story->category_id = $request->category;
        $story->author_id = $request->author;
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $tenhinh = str_random(4)."_".$name;
            while (file_exists("upload/".$tenhinh)) {
                $tenhinh = str_random(4)."_".$name;
            }
            $file->move("upload/",$tenhinh);
            $story->image = $tenhinh;
        }    
    	$story->status = 1;
        $story->created_at = Carbon::now();
        $story->updated_at = Carbon::now();

   		$story->save();
   		return response()->json($story);    	
    }

    public function update(Request $request, $storySlug ,$storyId)
    {
        $story = Story::findOrFail($storyId);
        if($story->slug == $storySlug)
        {	
        	$this->validate($request,
        		[
        			'name' => 'required|min:2|max:50|',
                    'image' => 'mimes:jpeg,jpg,png,gif',
        		],
        		[
        			'name.required' => 'Không được để trống tên',
        			'name.min' => 'Tên giới hạn 2-50 ký tự',
        			'name.max' => 'Tên giới hạn 2-50 ký tự',
                    'image.mimes' => 'Chỉ được upload file ảnh',
        		]);
            $story->name = $request->name;
            $story->description = $request->description;
        	$story->category_id = $request->category;
        	$story->author_id = $request->author ;
            if($request->hasFile('image'))
            {
                $file = $request->file('image');
                $name = str_slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
                $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
                $tenhinh = str_random(4)."_".$name.'.'.$extension;
                while (file_exists("upload/".$tenhinh)) {
                    $tenhinh = str_random(4)."_".$name.'.'.$extension;
                }
                if($story->image && file_exists($story->image))
                {
                    unlink("upload/".$story->image);
                }
                $file->move("upload/",$tenhinh);
                $story->image = $tenhinh;
            }    
            $story->save();
            return response()->json(["success" => "Edit success"]);
        }
        else return response()->json(["error" => "Edit fail"]);
    }

    public function delete(Request $request)
    {
        if($request->ajax())
        {       
            $id = $request->id;
            $story = Story::findOrFail($id);
            $story->delete();
            return response()->json(['success' => 'Delete success']);
        }    }

    public function deleteMulti(Request $request)
    {
        if($request->ajax())
        {
            $id = $request->id;
            $story = Story::whereIn('id',$id);
            $story->delete();
            return response()->json(["success" => "Delete success"]);
        }
    }

    public function changeStatus(Request $request)
    {
        $story = Story::find($request->id);
        $status = 0;
        if($request->checked == "true")
        {
            $status = 1;
        }
        $story->status = $status;
        $story->save();
        return response()->json(['success' => 'Thay đổi trạng thái thành công']);    	
    }
}
