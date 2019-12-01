<?php

namespace App\Events\ModuleSettingProperty;

use App\DbModels\ModuleSettingProperty;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ModuleSettingPropertyCreatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var ModuleSettingProperty
     */
    public $moduleSettingProperty;

    /**
     * Create a new event instance.
     *
     * @param ModuleSettingProperty $moduleSettingProperty
     * @param array $options
     */
    public function __construct(ModuleSettingProperty $moduleSettingProperty, array $options = [])
    {
        $this->moduleSettingProperty = $moduleSettingProperty;
        $this->options = $options;
    }
}
