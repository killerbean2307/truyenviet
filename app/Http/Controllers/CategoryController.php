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
        // ->addColumn('check', function($categories) {return '<input type="checkbox" name="delete-item[]" class="delete-multi-checkbox" value="'.$categories->id.'"/>';},0)
        // ->addColumn('action',function($category){return '
        //     <a class="btn btn-success btn-small show-button text-white" data-toggle="modal" data-target="#showModal" data-id="'.$category->id.'"><i class="fa fa-fw fa-eye"></i>Xem</a> 
        //     <a class="btn btn-info btn-small edit-button text-white" data-toggle="modal" data-target="#editModal" data-id="'.$category->id.'"><i class="fa fa-fw fa-pencil"></i>Sửa</a>
        //     <a class="btn btn-danger btn-small delete-button text-white" data-toggle="modal" data-target="#deleteModal" data-id="'.$category->id.'"><i class="fa fa-fw fa-trash"></i>Xóa</a>';},7)
        // ->rawColumns(['check','action'])
        ->make(true);
    }

    public function getStoryView($categorySlug)
    {
        $category = Category::findBySlugOrFail($categorySlug);
        $story = $category->story;
        // dd($story);
        return view('admin.category.detail', compact(['story','category']));
    }

    public function getStoryByCategorySlug($categorySlug)
    {
        // $category = Category::findOrFail($id);
        $stories = Category::findBySlugOrFail($categorySlug)->story;
        foreach($stories as $story)
        {
            $story->author->name;
        }
        // ->addColumn('action',function($story){return '
        //     <a class="btn btn-success btn-small show-button text-white" data-toggle="modal" data-target="#showModal" data-id="'.$story->id.'"><i class="fa fa-fw fa-eye"></i>Xem</a> 
        //      <a class="btn btn-info btn-small edit-button text-white" data-toggle="modal" data-target="#editModal" data-id="'.$story->id.'"><i class="fa fa-fw fa-pencil"></i>Sửa</a>
        //     <a class="btn btn-danger btn-small delete-button text-white" data-toggle="modal" data-target="#deleteModal" data-id="'.$story->id.'"><i class="fa fa-fw fa-trash"></i>Xóa</a>';},11)->rawColumns(['action'])
        return Datatables::of($stories)->make(true);
    }

    public function store(Request $request)
    {
    	$this->validate($request,
    		[
    			'name' => 'required|min:2|max:200',
    		],
    		[
    			'name.required' => 'Tên không được để trống',
    			'name.min' => 'Tên giới hạn 2-200 ký tự',
    			'name.max' => 'Tên giới hạn 2-200 ký tự',
    		]);
    	// $data['name'] = $request->name;
    	// $data['description'] = $request->description;
     //    $data['status'] = 1;
     //    $data['created_at'] = Carbon::now();
     //    $data['updated_at'] = Carbon::now();
    	// $category = Category::luu($data);
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
