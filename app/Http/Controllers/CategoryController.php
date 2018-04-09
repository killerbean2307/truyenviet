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

class CategoryController extends Controller
{
    public function index()
    {
    	return view('admin.category.list');
    }

    public function getAll(Request $request)
    {  
        $category = DB::table('category');

        if($request->name)
        {
            $category = $category->where('name','like','%'.$request->name.'%')->get();
        }

        return Datatables::of($category)
        ->make(true);
    }

    public function getStoryView($categorySlug)
    {
        $categories = Category::select('id','name')->get();
        $authors = Author::select('id','name')->get();
        $storyCategory = Category::findBySlugOrFail($categorySlug);
        return view('admin.story.list', compact(['categories','authors','storyCategory']));
    }

    public function getStoryByCategorySlug($categorySlug)
    {
        $stories = Category::findBySlugOrFail($categorySlug)->story;
        foreach($stories as $story)
        {
            if($story->author)
                $story->author;
            $story->category;
        }
        return Datatables::of($stories)->make(true);
    }

    public function store(Request $request)
    {
    	$this->validate($request,
    		[
    			'name' => 'required|min:2|max:200|unique:Category,name',
    		],
    		[
    			'name.required' => 'Tên không được để trống',
    			'name.min' => 'Tên giới hạn 2-200 ký tự',
    			'name.max' => 'Tên giới hạn 2-200 ký tự',
                'name.unique' => 'Tên đã trùng',
    		]);
        $category= new Category;
        $category->name= $request->name;
        $category->description= $request->description;
        $category->status = 1;
        $category->created_at = Carbon::now();
        $category->updated_at = Carbon::now();

        $category->save();
    	return response()->json($category);
    }

    // public function edit($id)
    // {
    // 	$category = Category::find($id);
    // 	return view('admin.category.edit', compact('category')); 
    // }

    public function changeStatus(Request $request)
    {
        $category = Category::find($request->id);
        $status = 0;
        if($request->checked == "true")
        {
            $status = 1;
        }
        $category->status = $status;
        $category->save();
        return response()->json($category->status);
    }

    // public function show($id)
    // {
    //     $category = Category::findOrFail($id);
    //     return response()->json($category);
    // }

    public function update(Request $request, $categorySlug)
    {
        if($request->ajax())
        {
            $category = Category::findBySlugOrFail($categorySlug);
            $this->validate($request,
            [
                'name' => 'required|min:2|max:200|unique:Category,name,'.$category->id,
            ],
            [
                'name.required' => 'Tên không được để trống',
                'name.min' => 'Tên giới hạn 2-200 ký tự',
                'name.max' => 'Tên giới hạn 2-200 ký tự',
                'name.unique' => 'Tên đã trùng, vui lòng nhập tên khác',
            ]
            );
            $category->name = $request->name;
            $category->description = $request->description;
            $category->save();
            return response()->json(["success" => "Edit success"]);
        }
    }

    public function delete(Request $request)
    {
        if($request->ajax())
        {       
            $id = $request->id;
            $category = Category::findBySlugOrFail($id);
            $category->delete();
            return response()->json(['success' => 'Delete success']);
        }
    }

    public function deleteMulti(Request $request)
    {
        if($request->ajax())
        {
            $id = $request->id;
            $category = Category::whereIn('id',$id);
            $category->delete();
            return response()->json(["success" => "Delete success"]);
        }
    }


}
