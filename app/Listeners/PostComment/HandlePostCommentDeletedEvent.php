<?php

namespace App\Listeners\PostComment;

use App\Events\Post\PostUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePostCommentDeletedEvent implements ShouldQueue
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
        $postComment = $event->post;
        $eventOptions = $event->options;
    }
}
