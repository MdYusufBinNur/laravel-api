<?php

namespace App\Events\PaymentPublishLog;

use App\DbModels\PaymentPublishLog;
use Illuminate\Queue\SerializesModels;

class PaymentPublishLogUpdatedEvent
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
