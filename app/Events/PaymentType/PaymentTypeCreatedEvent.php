<?php

namespace App\Events\PaymentType;

use App\DbModels\PaymentType;
use Illuminate\Queue\SerializesModels;

class PaymentTypeCreatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var PaymentType
     */
    public $paymentType;

    /**
     * Create a new event instance.
     *
     * @param PaymentType $paymentType
     * @param array $options
     */
    public function __construct(PaymentType $paymentType, array $options = [])
    {
        $this->paymentType = $paymentType;
        $this->options = $options;
    }
}
