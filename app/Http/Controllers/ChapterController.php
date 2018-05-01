<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Story;
use App\Chapter;

class ChapterController extends Controller
{
    public function store(Request $request)
    {
    	$this->validate($request,[
    		'name' => 'max:191',
    		'ordering' => 'numeric',
    		'content' => 'required'
    	],
    	[
    		'content.required' => 'Không được phép để trống nội dung',
    		'name.max' => 'Tên truyện tối đa 191 ký tự',
    		'ordering.numeric' => 'Thứ tự bắt buộc phải là số'
        ]);
        $story = Story::find($request->story_id);
        if($story->isFull()){
            return response()->json(["message" => "Story is end", "errors" => ["content" => "Truyện đã full. Không thể thêm chương mới"]],422);
        }
    	$chapter = new Chapter();
    	$chapter->name = $request->name;
    	$chapter->content = $request->content;
    	$chapter->ordering = $request->ordering;
    	$chapter->story_id = $request->story_id;
    	$chapter->user_id =1;
    	$chapter->save();
    	return response()->json($chapter);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'max:191',
            'ordering' => 'numeric',
            'content' => 'required'
        ],
        [
            'content.required' => 'Không được phép để trống nội dung',
            'name.max' => 'Tên truyện tối đa 191 ký tự',
            'ordering.numeric' => 'Thứ tự bắt buộc phải là số'
        ]);

        $chapter = Chapter::find($id);
        $chapter->name = $request->name;
        $chapter->content = $request->content;
        $chapter->ordering = $request->ordering;
        $chapter->user_id =1;
        $chapter->save();

        return response()->json($chapter);
    }

    public function delete(Request $request)
    {
        if(Chapter::destroy($request->id))
        	return response()->json(['success' => 'Xóa thành công']);
    }

    public function deleteMulti(Request $request)
    {
        $id = $request->id;
        if(Chapter::destroy($id))
            return response()->json(['success' => 'Xóa thành công']);
    }

    public function getDetail($id)
    {
        $chapter = Chapter::find($id);
        $chapter->user->name;
        return response()->json($chapter);
    }
}
