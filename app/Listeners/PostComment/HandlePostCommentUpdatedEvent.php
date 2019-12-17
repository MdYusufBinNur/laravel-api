<?php

namespace App\Listeners\Post;

use App\Events\PostComment\PostCommentUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePostCommentUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param PostCommentUpdatedEvent $event
     * @return void
     */
    public function handle(PostCommentUpdatedEvent $event)
    {
        $postComment = $event->postComment;
        $eventOptions = $event->options;
    }
}
