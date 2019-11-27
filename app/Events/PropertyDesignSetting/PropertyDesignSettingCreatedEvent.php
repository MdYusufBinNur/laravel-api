<?php

namespace App\Events\PropertyDesignSetting;

use App\DbModels\PropertyDesignSetting;
use Illuminate\Queue\SerializesModels;

class PropertyDesignSettingCreatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var PropertyDesignSetting
     */
    public $propertyDesignSetting;

    /**
     * Create a new event instance.
     *
     * @param PropertyDesignSetting $propertyDesignSetting
     * @param array $options
     */
    public function __construct(PropertyDesignSetting $propertyDesignSetting, array $options = [])
    {
        $this->propertyDesignSetting = $propertyDesignSetting;
        $this->options = $options;
    }
}
