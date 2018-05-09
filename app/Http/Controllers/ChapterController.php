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
use Illuminate\Support\Facades\Auth;

class ChapterController extends Controller
{
    public function store(Request $request)
    {
    	$this->validate($request,[
    		'name' => 'max:191',
    		'ordering' => 'required|numeric|min:1',
    		'content' => 'required'
    	],
    	[
            'ordering.required' => 'Thứ tự không được để trống',
    		'content.required' => 'Không được phép để trống nội dung',
    		'name.max' => 'Tên truyện tối đa 191 ký tự',
    		'ordering.numeric' => 'Thứ tự bắt buộc phải là số',
            'ordering.min' => 'Thứ tự phải bắt đầu từ 1'
        ]);

        $story = Story::find($request->story_id);

        if($story->user_id != Auth::id())
            return response()->json(['error' => 'Truyện không do bạn phụ trách. Không đủ quyền hạn', 'code' => 403], 403);

        if($story->isFull()){
            return response()->json(["message" => "Story is end", "errors" => ["content" => "Truyện đã full. Không thể thêm chương mới"]],422);
        }

        $order = $story->chapter->pluck('ordering');

        if($order->contains($request->ordering)){
            return response()->json(["message" => "Ordering is duplicate", "errors" => ["content" => "Chương ".$request->ordering." đã có. Hãy thêm chương khác"]],422);
        }

    	$chapter = new Chapter();
    	$chapter->name = $request->name;
    	$chapter->content = $request->content;
    	$chapter->ordering = $request->ordering;
    	$chapter->story_id = $request->story_id;
    	$chapter->user_id = Auth::id();
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
        if($chapter->story->user_id != Auth::id() and Auth::user()->level < 2)
            return response()->json(['error' => 'Truyện không do bạn phụ trách. Không đủ quyền hạn', 'code' => 403], 403);

        $chapter->name = $request->name;
        $chapter->content = $request->content;
        $chapter->ordering = $request->ordering;
        $chapter->updated_by = Auth::id();
        $chapter->save();

        return response()->json($chapter);
    }

    public function delete(Request $request)
    {
        if(Auth::id() != Chapter::find($request->id)->story->user_id and Auth::user()->level < 2)
        {
            return response()->json(['error' => 'Truyện không do bạn phụ trách. Không đủ quyền hạn', 'code' => 403], 403);
        }

        if(Chapter::destroy($request->id))
        	return response()->json(['success' => 'Xóa thành công']);
    }

    public function deleteMulti(Request $request)
    {
        $id = $request->id;
        if(Chapter::find($id[0])->story->user_id and Auth::user()->level < 2)
            return response()->json(['error' => 'Truyện không do bạn phụ trách. Không đủ quyền hạn', 'code' => 403], 403);
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
