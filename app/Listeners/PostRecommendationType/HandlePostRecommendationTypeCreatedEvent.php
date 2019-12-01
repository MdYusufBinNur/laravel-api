<?php

namespace App\Listeners\PostRecommendationType;

use App\Events\PostRecommendationType\PostRecommendationTypeCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePostRecommendationTypeCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  PostRecommendationTypeCreatedEvent  $event
     * @return void
     */
    public function handle(PostRecommendationTypeCreatedEvent $event)

    {
        $postRecommendationType = $event->postRecommendationType;
        $eventOptions = $event->options;
    }
}
