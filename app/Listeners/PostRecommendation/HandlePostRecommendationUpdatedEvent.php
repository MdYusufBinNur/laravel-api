<?php

namespace App\Listeners\PostRecommendation;

use App\Events\PostRecommendation\PostRecommendationUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePostRecommendationUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  PostRecommendationUpdatedEvent  $event
     * @return void
     */
    public function handle(PostRecommendationUpdatedEvent $event)
    {
        $postRecommendation = $event->postRecommendation;
        $eventOptions = $event->options;
        $oldPostRecommendation = $eventOptions['oldModel'];
    }
}
