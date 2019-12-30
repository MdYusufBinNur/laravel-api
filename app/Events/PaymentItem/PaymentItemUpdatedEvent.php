<?php

namespace App\Events\PaymentItem;

use App\DbModels\PaymentItem;
use App\Http\Resources\PaymentItemResource;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PaymentItemUpdatedEvent implements ShouldBroadcast
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

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|\Illuminate\Broadcasting\Channel[]
     */
    public function broadcastOn()
    {
        $toUserIds = [];
        if (!empty($this->paymentItem->unitId)) {
            $toUserIds = $this->paymentItem->unit->getResidentsUserIds();
        }

        if (!empty($this->paymentItem->userId)) {
            $toUserIds[] = $this->paymentItem->userId;
        }

        $channels = [];
        foreach ($toUserIds as $userId) {
            $channels[] = new PrivateChannel('USER.' . $userId);
        }

        return $channels;

    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastAs()
    {
        return ['paymentItemUpdated'];
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        request()->merge(['include' => 'pi.payment,pi.user,pi.unit']);
        return [
            'post' => new PaymentItemResource($this->paymentItem)
        ];
    }

}
