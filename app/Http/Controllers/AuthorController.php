<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Author;

class AuthorController extends Controller
{
 
    public function index()
    {
    	return view('admin.author.list');
    }

        public function getAll(Request $request)
    {  
        $authors = DB::table('author');

        if($request->name != "")
        {
            $authors = $authors->where('name','like','%'.$request->name.'%')->get();
        }

        return Datatables::of($authors)
        ->make(true);
    }


    public function create()
    {
    	return view('admin.author.add');
    }

    public function store(Request $request)
    {
    	$this->validate($request,
    		[
    			'name' => 'required|min:2|max:50|unique:Author,name',
    		],
    		[
    			'name.required' => 'Không được để trống tên',
    			'name.min' => 'Tên giới hạn 2-50 ký tự',
    			'name.max' => 'Tên giới hạn 2-50 ký tự',
    			'name.unique' => 'Tên đã trùng',
    		]);
    	$author = new Author;
    	$author->name = $request->name;
    	$author->status = 1;

   		$author->save();
   		return response()->json($author);
    }

    // public function edit($id)
    // {
    // 	$author = Author::find($id);
    // 	return view('admin.author.edit', compact('author'));
    // }
    public function getStoryView()
    {
        
    }

    public function update(Request $request, $id)
    {
    	$author = Author::find($id);
    	$this->validate($request,
    		[
    			'name' => 'required|min:2|max:50|',
    		],
    		[
    			'name.required' => 'Không được để trống tên',
    			'name.min' => 'Tên giới hạn 2-50 ký tự',
    			'name.max' => 'Tên giới hạn 2-50 ký tự',
    		]);
    	$data['name'] = $author->name;
    	if($author->name != $request->name)
    	{
    		$this->validate($request, 
    		[
    			'name' => 'unique:Author,name',
    		], 
    		[
    			'name.unique' => 'Tên đã trùng',
    		]);
    	
    		$data['name'] = $request->name;
    	}
    	
    	$data['status'] = 0;
    	if($request->status)
    	{
    		$data['status'] = 1;
    	}
   		Author::sua($id,$data);

   		return redirect(route('admin.author.list'))->with('thongbao','Sửa tác giả thành công');    	
    }

    public function changeStatus(Request $request)
    {
        $category = Author::find($request->id);
        $status = 0;
        if($request->checked == "true")
        {
            $status = 1;
        }
        $category->status = $status;
        $category->save();
        return response()->json($category->status);
    }


    public function delete(Request $request)
    {
        $id = $request->input('id');
    	Author::xoa($id);
    	return redirect(route('admin.author.list'))->with('thongbao', 'Xóa tác giả thành công');
    }

    public function deleteMulti(Request $request)
    {
        if($request->has('delete-item')) {
            $id = $request->input('delete-item');

            Author::xoaNhieu($id);
            return redirect(route('admin.author.list'))->with('thongbao', 'Xóa tác giả thành công');
        }
        return redirect()->back()->withErrors('Bạn chưa chọn bản ghi nào');
    }
}
