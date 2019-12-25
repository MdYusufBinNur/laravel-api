<?php

namespace App\Events\PaymentItem;

use App\DbModels\PaymentItem;
use Illuminate\Queue\SerializesModels;


class PaymentItemCreatedEvent
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
