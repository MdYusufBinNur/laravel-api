<?php

namespace App\Listeners\PostRecommendationType;

use App\Events\PostRecommendationType\PostRecommendationTypeUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePostRecommendationTypeUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  PostRecommendationTypeUpdatedEvent  $event
     * @return void
     */
    public function handle(PostRecommendationTypeUpdatedEvent $event)
    {
        $postRecommendationType = $event->postRecommendationType;
        $eventOptions = $event->options;
        $oldPostRecommendationType = $eventOptions['oldModel'];
    }
}
