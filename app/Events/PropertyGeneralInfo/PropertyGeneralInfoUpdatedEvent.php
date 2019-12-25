<?php

namespace App\Events\PropertyGeneralInfo;

use App\DbModels\PropertyGeneralInfo;
use Illuminate\Queue\SerializesModels;

class PropertyGeneralInfoUpdatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var PropertyGeneralInfo
     */
    public $propertyGeneralInfo;

    /**
     * Create a new event instance.
     *
     * @param PropertyGeneralInfo $propertyGeneralInfo
     * @param array $options
     */
    public function __construct(PropertyGeneralInfo $propertyGeneralInfo, array $options = [])
    {
        $this->propertyGeneralInfo = $propertyGeneralInfo;
        $this->options = $options;
    }
}
