<?php

namespace App\Listeners\Tower;

use App\Events\Tower\TowerCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleTowerCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  TowerCreatedEvent  $event
     * @return void
     */
    public function handle(TowerCreatedEvent $event)
    {
        $tower = $event->tower;
        $eventOptions = $event->options;
    }
}
