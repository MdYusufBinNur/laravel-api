<?php

namespace App\Listeners\Tower;

use App\Events\Tower\TowerUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleTowerUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  TowerUpdatedEvent  $event
     * @return void
     */
    public function handle(TowerUpdatedEvent $event)
    {
        $tower = $event->tower;
        $eventOptions = $event->options;
        $oldTower = $eventOptions['oldModel'];
    }
}
