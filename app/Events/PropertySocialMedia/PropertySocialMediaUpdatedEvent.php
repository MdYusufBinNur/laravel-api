<?php

namespace App\Events\PropertySocialMedia;

use App\DbModels\PropertySocialMedia;
use Illuminate\Queue\SerializesModels;

class PropertySocialMediaUpdatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var PropertySocialMedia
     */
    public $propertySocialMedia;

    /**
     * Create a new event instance.
     *
     * @param PropertySocialMedia $propertySocialMedia
     * @param array $options
     */
    public function __construct(PropertySocialMedia $propertySocialMedia, array $options = [])
    {
        $this->propertySocialMedia = $propertySocialMedia;
        $this->options = $options;
    }
}
