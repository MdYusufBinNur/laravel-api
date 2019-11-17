<?php

namespace App\Listeners\PostComment;

use App\Events\PostComment\PostCommentCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePostCommentCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param PostCommentCreatedEvent $event
     * @return void
     */
    public function handle(PostCommentCreatedEvent $event)
    {
        $postComment = $event->post;
        $eventOptions = $event->options;
    }
}
