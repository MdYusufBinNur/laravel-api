<?php

namespace App\Listeners\PostWall;

use App\Events\PostWall\PostWallCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePostWallCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  PostWallCreatedEvent  $event
     * @return void
     */
    public function handle(PostWallCreatedEvent $event)
    {
        $postWall = $event->postWall;
        $eventOptions = $event->options;
    }
}
