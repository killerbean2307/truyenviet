<?php

namespace App\Http\Middleware;

use Closure;

class StoryOfUser
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
        if(Auth::id() == $request->user_id)
            return $next($request);
        else 
            abort(403);
            return response()->json(['error' => 'Truyện không do bạn phụ trách. Không đủ quyền hạn', 'code' => 403], 403);
    }
}
