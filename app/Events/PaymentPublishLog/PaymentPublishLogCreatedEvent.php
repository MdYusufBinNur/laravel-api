<?php

namespace App\Events\PaymentPublishLog;

use App\DbModels\PaymentPublishLog;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PaymentPublishLogCreatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var PaymentPublishLog
     */
    public $paymentPublishLog;

    /**
     * Create a new event instance.
     *
     * @param PaymentPublishLog $paymentPublishLog
     * @param array $options
     */
    public function __construct(PaymentPublishLog $paymentPublishLog, array $options = [])
    {
        $this->paymentPublishLog = $paymentPublishLog;
        $this->options = $options;
    }
}
