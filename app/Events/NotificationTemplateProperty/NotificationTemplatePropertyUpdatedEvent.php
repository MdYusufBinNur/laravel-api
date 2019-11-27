<?php

namespace App\Events\NotificationTemplateProperty;

use App\DbModels\NotificationTemplateProperty;
use Illuminate\Queue\SerializesModels;

class NotificationTemplatePropertyUpdatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var NotificationTemplateProperty
     */
    public $notificationTemplateProperty;

    /**
     * Create a new event instance.
     *
     * @param NotificationTemplateProperty $notificationTemplateProperty
     * @param array $options
     */
    public function __construct(NotificationTemplateProperty $notificationTemplateProperty, array $options = [])
    {
        $this->notificationTemplateProperty = $notificationTemplateProperty;
        $this->options = $options;
    }
}
