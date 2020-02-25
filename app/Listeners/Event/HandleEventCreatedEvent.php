<?php

namespace App\Listeners\Event;

use App\DbModels\Post;
use App\Events\Event\EventCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Repositories\Contracts\PostEventRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleEventCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param EventCreatedEvent $event
     * @return void
     */
    public function handle(EventCreatedEvent $event)
    {
        $eventModel = $event->eventModel;
        $eventOptions = $event->options;

        // not from post-event
        if (!isset($eventOptions['request']['post']) && $eventModel->allowedSignUp) {
            $postEventRepository = app(PostEventRepository::class);
            $postEventRepository->save([
                'eventId' => $eventModel->id,
                'post' => ['type' => Post::TYPE_EVENT, 'createdByUserId' => $eventModel->createdByUserId , 'propertyId' => $eventModel->propertyId, 'attachmentIds' => $eventOptions['attachmentIds'] ?? []]
            ]);
        }
    }
}
