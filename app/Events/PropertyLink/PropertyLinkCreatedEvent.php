<?php

namespace App\Events\PropertyLink;

use App\DbModels\PropertyLink;
use Illuminate\Queue\SerializesModels;

class PropertyLinkCreatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var PropertyLink
     */
    public $propertyLink;

    /**
     * Create a new event instance.
     *
     * @param PropertyLink $propertyLink
     * @param array $options
     */
    public function __construct(PropertyLink $propertyLink, array $options = [])
    {
        $this->propertyLink = $propertyLink;
        $this->options = $options;
    }
}
