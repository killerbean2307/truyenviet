<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check())
        {
            $user = Auth::user();
            if($user->level == 2 )
                return $next($request);
        }
        else
            abort(403);
            return response()->json(['error' => 'Bạn không có quyền sử dụng chức năng này', 'code' => 403], 403);
    }
}
