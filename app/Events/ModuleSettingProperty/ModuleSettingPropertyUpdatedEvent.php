<?php

namespace App\Events\ModuleSettingProperty;

use App\DbModels\ModuleSettingProperty;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;

class ModuleSettingPropertyUpdatedEvent
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
