<?php

namespace App\Listeners\MessagePost;

use App\Events\MessagePost\MessagePostCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleMessagePostCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  MessagePostCreatedEvent  $event
     * @return void
     */
    public function handle(MessagePostCreatedEvent $event)
    {
        $messagePost = $event->messagePost;
        $eventOptions = $event->options;
    }
}
