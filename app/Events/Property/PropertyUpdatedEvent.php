<?php

namespace App\Events\Property;

use App\DbModels\Property;
use Illuminate\Queue\SerializesModels;

class PropertyUpdatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var Property
     */
    public $property;

    /**
     * Create a new event instance.
     *
     * @param Property $property
     * @param array $options
     */
    public function __construct(Property $property, array $options = [])
    {
        $this->property = $property;
        $this->options = $options;
    }
}
