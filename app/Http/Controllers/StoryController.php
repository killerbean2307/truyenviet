<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Story;
use App\Author;
use App\Chapter;
use App\User;
use App\ViewCount;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Auth;

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
    	$stories = Story::orderBy('updated_at', 'desc')->get();
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
        // $notification = array(
        //     'message' => 'I am a successful message!', 
        //     'alert-type' => 'success'
        // );
    	return view('admin.chapter.list', compact('story'));
    }

    public function getChaptersByStoryId($id)
    {
    	$story = Story::findOrFail($id);
    	$chapters = $story->chapter()->orderBy('ordering')->get();
  		if($chapters->isNotEmpty())
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
    	return response()->json([
            'id' => $story->id,
            'name' => $story->name,
            'author' => $story->author,
            'category' => $story->category,
            'created_at' => $story->created_at,
            'description' => $story->description,
            'image' => $story->image,
            'slug' => $story->slug,
            'source' => $story->source,
            'updated_at' => $story->updated_at,
            'updated_by' => $story->updated_by,
            'user' => $story->user,
            'view' => $story->view,
            'like' => $story->like,
            'name' => $story->name,
            'status' => $story->status,
            'chapter_count' => $story->chapter->count()
        ]);
    }

    public function store(Request $request)
    {
    	$this->validate($request,
    		[
    			'name' => 'required|min:2|max:50|unique:Story,name',
                'image' => 'mimes:jpeg,jpg,png,gif',
                'category' => 'required',
    		],
    		[
    			'name.required' => 'Không được để trống tên',
    			'name.min' => 'Tên giới hạn 2-50 ký tự',
    			'name.max' => 'Tên giới hạn 2-50 ký tự',
    			'name.unique' => 'Tên đã trùng',
                'image.mimes' => 'Chỉ được upload file ảnh',
                'category.required' => 'Không được để trống thể loại',
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
        $story->user_id = Auth::id();
   		$story->save();

        $viewCountStory = new ViewCount;
        $viewCountStory->story_id = $story->id;
        $viewCountStory->save();
   		return response()->json($story);    	
    }

    public function update(Request $request, $storyId)
    {
        $story = Story::findOrFail($storyId);
        if($story->user_id != Auth::id() and Auth::user()->level < 2)
        {
            return response()->json(['error' => 'Truyện không do bạn phụ trách. Không được phép sửa', 'code' => 403], 403);
        }
        	$this->validate($request,
        		[
        			'name' => 'required|min:2|max:50|unique:Story,name,'.$story->id,
                    'image' => 'mimes:jpeg,jpg,png,gif',
                    'category' => 'required'
        		],
        		[
        			'name.required' => 'Không được để trống tên',
        			'name.min' => 'Tên giới hạn 2-50 ký tự',
        			'name.max' => 'Tên giới hạn 2-50 ký tự',
                    'name.unique' => 'Tên đã trùng',
                    'image.mimes' => 'Chỉ được upload file ảnh',
                    'category.required' => 'Không được để trống thể loại' 
        		]);
            $story->name = $request->name;
            $story->description = $request->description;
        	$story->category_id = $request->category;
        	$story->author_id = $request->author;
        	$story->status = $request->status;
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
            $story->updated_by = Auth::id();    
            $story->save();
            return response()->json(["success" => "Edit success"]);
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
        $story->updated_by = Auth::id();
        $story->save();
        return response()->json(['success' => 'Thay đổi trạng thái thành công']);    	
    }

    public function getLastestChapterOrder($id)
    {
        $story = Story::find($id);
        $lastOrder = $story->chapter()->orderBy('ordering','desc')->pluck('ordering')->first() ? $story->chapter()->orderBy('ordering','desc')->pluck('ordering')->first() : 0;
        return $lastOrder;        
    }
}
