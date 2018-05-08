<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Session\Store;
use Session;

class ViewFilter
{
    private $session;

    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $chapter = $this->getViewedChapter();

        if(!is_null($chapter))
        {
            $chapter = $this->cleanExpiredViews($chapter);
            $this->storeChapters($chapter);            
        }
        return $next($request);
    }

    private function getViewedChapter()
    {
        return $this->session->get('viewed', null);
    }

    private function cleanExpiredViews($chapter)
    {
        $time = time();

        $throttleTime = 900;

        return array_filter($chapter, function ($timestamp) use ($time, $throttleTime)
        {
            return ($timestamp + $throttleTime) > $time;
        }); 
    }

    private function storeChapters($chapter)
    {
        $this->session->put('viewed', $chapter);
    }
}
