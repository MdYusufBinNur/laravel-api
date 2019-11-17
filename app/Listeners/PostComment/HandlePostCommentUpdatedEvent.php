<?php

namespace App\Listeners\Post;

use App\Events\Post\PostUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePostCommentUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param PostUpdatedEvent $event
     * @return void
     */
    public function handle(PostUpdatedEvent $event)
    {
        $post = $event->post;
        $eventOptions = $event->options;
    }
}
