<?php

namespace App\Events\PropertyImage;

use App\DbModels\PropertyImage;
use Illuminate\Queue\SerializesModels;

class PropertyImageCreatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var PropertyImage
     */
    public $propertyImage;

    /**
     * Create a new event instance.
     *
     * @param PropertyImage $propertyImage
     * @param array $options
     */
    public function __construct(PropertyImage $propertyImage, array $options = [])
    {
        $this->propertyImage = $propertyImage;
        $this->options = $options;
    }
}
