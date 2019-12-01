<?php

namespace App\Events\PropertyLinkCategory;

use App\DbModels\PropertyLinkCategory;
use Illuminate\Queue\SerializesModels;

class PropertyLinkCategoryUpdatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var PropertyLinkCategory
     */
    public $propertyLinkCategory;

    /**
     * Create a new event instance.
     *
     * @param PropertyLinkCategory $propertyLinkCategory
     * @param array $options
     */
    public function __construct(PropertyLinkCategory $propertyLinkCategory, array $options = [])
    {
        $this->propertyLinkCategory = $propertyLinkCategory;
        $this->options = $options;
    }
}
