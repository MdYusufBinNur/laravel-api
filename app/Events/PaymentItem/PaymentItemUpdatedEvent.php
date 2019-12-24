<?php

namespace App\Events\PaymentItem;

use App\DbModels\PaymentItem;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PaymentItemUpdatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var PaymentItem
     */
    public $paymentItem;

    /**
     * Create a new event instance.
     *
     * @param PaymentItem $paymentItem
     * @param array $options
     */
    public function __construct(PaymentItem $paymentItem, array $options = [])
    {
        $this->paymentItem = $paymentItem;
        $this->options = $options;
    }

}
