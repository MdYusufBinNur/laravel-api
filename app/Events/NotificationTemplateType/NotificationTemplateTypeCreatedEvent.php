<?php

namespace App\Events\NotificationTemplateType;

use App\DbModels\NotificationTemplateType;
use Illuminate\Queue\SerializesModels;

class NotificationTemplateTypeCreatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var NotificationTemplateType
     */
    public $notificationTemplateType;

    /**
     * Create a new event instance.
     *
     * @param NotificationTemplateType $notificationTemplateType
     * @param array $options
     */
    public function __construct(NotificationTemplateType $notificationTemplateType, array $options = [])
    {
        $this->notificationTemplateType = $notificationTemplateType;
        $this->options = $options;
    }
}
