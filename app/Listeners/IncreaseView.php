<?php

namespace App\Listeners;

use App\Events\ChapterView;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Session\Store;

class IncreaseView
{
    private $session;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    /**
     * Handle the event.
     *
     * @param  ChapterView  $event
     * @return void
     */
    public function handle(ChapterView $event)
    {
        if(!$this->isChapterView($event->chapter))
        {
            $event->chapter->story->increment('view');
            $event->chapter->story->viewCount()->increment('day_view');
            $event->chapter->story->viewCount()->increment('week_view');
            $event->chapter->story->viewCount()->increment('month_view');
            $this->storeChapter($event->chapter);
        }
    }

    private function isChapterView($chapter)
    {
        $viewed = $this->session->get('viewed', []);
        return array_key_exists($chapter->id, $viewed);
    }

    private function storeChapter($chapter)
    {
        $key = 'viewed.'.$chapter->id;

        $this->session->put($key, time());
    }
}
