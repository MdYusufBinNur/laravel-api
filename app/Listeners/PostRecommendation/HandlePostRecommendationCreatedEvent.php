<?php

namespace App\Listeners\PostRecommendation;

use App\Events\PostRecommendation\PostRecommendationCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePostRecommendationCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  PostRecommendationCreatedEvent  $event
     * @return void
     */
    public function handle(PostRecommendationCreatedEvent $event)
    {
        $postRecommendation = $event->postRecommendation;
        $eventOptions = $event->options;
    }
}
