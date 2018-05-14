<?php

namespace App\Listeners;

use App\Events\ChapterView;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Cookie\CookieJar;


class SaveReadingStory
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  ChapterView  $event
     * @return void
     */
    public function handle(ChapterView $event)
    {
        $key = $event->chapter->story->slug;

        $cookie = Cookie::has('readingStory') ? json_decode(Cookie::get('readingStory'), true) : array();

        $cookie[$key] = array('name' => $event->chapter->story->name, 'ordering' =>  $event->chapter->ordering, 'time' => time());

        $cookie = json_encode($cookie);

        Cookie::forget('readingStory');

        // setcookie('readingStory',$cookie, time()+3600, '/');
        Cookie::queue('readingStory', $cookie, 525948);
        
    }
}
