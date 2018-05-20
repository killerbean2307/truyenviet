<?php

namespace App\Listeners;

use App\Events\StoryLike;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Cookie\CookieJar;

class LikeStory
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  StoryLike  $event
     * @return void
     */
    public function handle(StoryLike $event)
    {
        
    }
}
