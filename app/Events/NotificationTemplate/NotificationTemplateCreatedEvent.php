<?php

namespace App\Events\NotificationTemplate;

use App\DbModels\NotificationTemplate;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NotificationTemplateCreatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var NotificationTemplate
     */
    public $notificationTemplate;

    /**
     * Create a new event instance.
     *
     * @param NotificationTemplate $notificationTemplate
     * @param array $options
     */
    public function __construct(NotificationTemplate $notificationTemplate, array $options = [])
    {
        $this->notificationTemplate = $notificationTemplate;
        $this->options = $options;
    }
}
