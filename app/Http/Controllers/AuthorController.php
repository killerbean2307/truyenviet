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

class AuthorController extends Controller
{
 
    public function index()
    {
    	return view('admin.author.list');
    }

    public function getAll(Request $request)
    {  

        $authors = DB::table('author');
        return Datatables::of($authors)->make(true);
    }

    public function store(Request $request)
    {
    	$this->validate($request,
    		[
    			'name' => 'required|min:2|max:50|unique:Author,name',
                'image' => 'mimes:jpeg,jpg,png,gif',
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

    public function getStoryView($authorSlug)
    {
        $author = Author::findBySlugOrFail($authorSlug);
        $story = $author->story();
        return view('admin.author.detail', compact(['author','story']));
    }

    public function getStoryByAuthorSlug($authorSlug)
    {
        $stories = Author::findBySlugOrFail($authorSlug)->story;
        foreach($stories as $story)
        {
            $story->category->name;
        }
        return Datatables::of($stories)->make(true);
    }

    public function update(Request $request, $authorSlug)
    {
        	$author = Author::findBySlugOrFail($authorSlug);
        	$this->validate($request,
        		[
        			'name' => 'required|min:2|max:50|unique:Author,name,'.$author->id,
                    'image' => 'mimes:jpeg,jpg,png,gif',
        		],
        		[
        			'name.required' => 'Không được để trống tên',
        			'name.min' => 'Tên giới hạn 2-50 ký tự',
        			'name.max' => 'Tên giới hạn 2-50 ký tự',
                    'name.unique' => 'Tên đã trùng',
                    'image.mimes' => 'Chỉ được upload file ảnh',
        		]);
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
                if($author->image && file_exists($author->image))
                {
                    unlink("upload/".$author->image);
                }
                $file->move("upload/",$tenhinh);
                $author->image = $tenhinh;
            }    
            $author->save();
            return response()->json(["success" => "Edit success"]);
    }

    public function changeStatus(Request $request)
    {
        $author = Author::find($request->id);
        $status = 0;
        if($request->checked == "true")
        {
            $status = 1;
        }
        $author->status = $status;
        $author->save();
        return response()->json($author->status);
    }


    public function delete(Request $request)
    {
        if($request->ajax())
        {       
            $id = $request->id;
            $author = Author::findBySlugOrFail($id);
            $author->delete();
            return response()->json(['success' => 'Delete success']);
        }    }

    public function deleteMulti(Request $request)
    {
        if($request->ajax())
        {
            $id = $request->id;
            $author = Author::whereIn('id',$id);
            $author->delete();
            return response()->json(["success" => "Delete success"]);
        }
    }
}
