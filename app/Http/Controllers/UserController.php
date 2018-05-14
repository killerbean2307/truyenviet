<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use App\User;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Cviebrock\EloquentSluggable\Sluggable;

class UserController extends Controller
{
    public function index()
    {
    	return view('admin.user.list');
    }

    public function getAll()
    {
    	$users = User::orderBy('level', 'desc')->get();

    	return Datatables::of($users)->make(true);
    }

    public function getDetail($userId)
    {
    	$user = User::findOrFail($userId);

    	return response()->json($user);
    }

    public function store(Request $request)
    {
    	$this->validate($request,
    		[
    			'name' => 'required|unique:Users,name',
    			'email' => 'required|email|unique:Users,email',
    			'password' => 'required|min:3|max:50',
    			'level' => 'required',
    			'confirmPassword' => 'same:password'

    		],
    		[
    			'name.required' => 'Vui lòng nhập tên',
                'name.unique' => 'Tên đã trùng',
    			'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Email không đúng định dạng',
                'email.unique' => 'Email đã trùng',
    			'password.required' => 'Vui lòng nhập mật khẩu',
    			'password.min' => 'Mật khẩu tối thiểu :min ký tự',
    			'password.max' => 'Mật khẩu tối đa :max ký tự',
    			'confirmPassword.same' => 'Hãy nhập lại chính xác mật khẩu',
    			'level.required' => 'Vui lòng chọn cấp độ tài khoản',
    		]
    	);

    	$user = new User();

    	$user->name = $request->name;
    	$user->email = $request->email;
    	$user->password = bcrypt($request->pasword);
    	$user->level = $request->level;

    	$user->save();

        return response()->json(['success' => 'Added user']);
    }

    public function update(Request $request, $userId)
    {
    	$user = User::findOrFail($userId);
    	$this->validate($request,
    		[
    			'name' => 'bail|required|unique:users,name,'.$user->id,
    			'email' => 'bail|required|email|unique:users,email,'.$user->id,
    			'level' => 'required',
    		],
    		[
    			'name.required' => 'Vui lòng nhập tên',
                'name.unique' => 'Tên đã trùng',
                'email.unique' => 'Email đã trùng',
    			'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Email không đúng định dạng',
    			'level.required' => 'Vui lòng chọn cấp độ tài khoản',
    		]
    	);

        if($request->password != null)
        {
            $this->validate($request,
                [
                    'password' => 'bail|required|min:3|max:50',
                    'confirmPassword' => 'bail|same:password',
                ],
                [
                    'password.required' => 'Vui lòng nhập mật khẩu',
                    'password.min' => 'Mật khẩu tối thiểu 3 ký tự',
                    'password.max' => 'Mật khẩu tối đa 50 ký tự',
                    'confirmPassword.same' => 'Hãy nhập lại chính xác mật khẩu',
                ]
            );
        }

    	$user->name = $request->name;
    	$user->email = $request->email;
        if($request->password != null)
        {    
    	   $user->password = bcrypt($request->password);
        }
    	$user->level = $request->level;

    	$user->save();

    	return response()->json(['success' => 'Updated user']);    	
    }

    public function delete(Request $request)
    {
    	if($request->ajax())
        {
            $id = $request->id;
            $user = User::find($id);
            if($user->id != Auth::id() and $user->level < 2)
            {
                $user->delete();
                return response()->json(["success" => "Delete success"]);
            }
            else if($user->level == 2)
            {
                 return response()->json(['error' => 'Bạn không được xóa tài khoản admin', 'code' => 403], 403);
            }
            else 
                return response()->json(['error' => 'Bạn không được xóa tài khoản đang đăng nhập', 'code' => 403], 403);
        }
    }

    public function deleteMulti(Request $request)
    {
    	if($request->ajax())
        {
            $id = $request->id;
            $user = User::whereIn('id', $id)->get();
            foreach ($user as $key => $value) {
                if($value->level == 2)
                {
                    return response()->json(['error' => 'Bạn không được xóa tài khoản admin', 'code' => 403], 403);
                }
                else if($value->id == Auth::id())
                {
                    return response()->json(['error' => 'Bạn không được xóa tài khoản đang đăng nhập', 'code' => 403], 403);
                }
            }
            User::destroy($id);
            return response()->json(["success" => "Delete success"]);
        }
    }

    public function changeStatus(Request $request)
    {
    	$user = User::findOrFail($request->id);
        $active = $request->check;
        if(Auth::user()->level < 2)
        {
            return response()->json(['error' => 'Bạn không có quyền thay đổi trạng thái tài khoản', 'code' => 403], 403);
        }
        $user->active = $active;
        $user->save();
        return response()->json(['success' => 'Change status success'],200);
    }
}
