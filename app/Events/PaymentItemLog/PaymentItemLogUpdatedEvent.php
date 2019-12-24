<?php

namespace App\Events\PaymentItemLog;

use App\DbModels\PaymentItemLog;
use Illuminate\Queue\SerializesModels;

class PaymentItemLogUpdatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var PaymentItemLog
     */
    public $paymentItemLog;

    /**
     * Create a new event instance.
     *
     * @param PaymentItemLog $paymentItemLog
     * @param array $options
     */
    public function __construct(PaymentItemLog $paymentItemLog, array $options = [])
    {
        $this->paymentItemLog = $paymentItemLog;
        $this->options = $options;
    }
}
