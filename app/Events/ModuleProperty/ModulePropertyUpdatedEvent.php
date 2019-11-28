<?php

namespace App\Events\ModuleProperty;

use App\DbModels\ModuleProperty;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;

class ModulePropertyUpdatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var ModuleProperty
     */
    public $moduleProperty;

    /**
     * Create a new event instance.
     *
     * @param ModuleProperty $moduleProperty
     * @param array $options
     */
    public function __construct(ModuleProperty $moduleProperty, array $options = [])
    {
        $this->moduleProperty = $moduleProperty;
        $this->options = $options;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
