<?php

namespace App\Listeners\Event;

use App\DbModels\Post;
use App\Events\Event\EventCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Repositories\Contracts\PostEventRepository;
use App\Repositories\Contracts\PostRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleEventCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  EventUpdatedEvent  $event
     * @return void
     */
    public function handle(EventCreatedEvent $event)
    {
        $eventModel = $event->eventModel;
        $eventOptions = $event->options;

        if ($eventModel->allowedSignUp) {
            $postEventRepository = app(PostEventRepository::class);
            $postEventRepository->save([
                'eventId' => $eventModel->id,
                'post' => ['type' => Post::TYPE_EVENT, 'propertyId' => $eventModel->propertyId, 'attachmentIds' => $eventOptions['attachmentIds'] ?? []]
            ]);
        }
    }
}
