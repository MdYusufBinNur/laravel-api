<?php

namespace App\Events\PaymentRecurring;

use App\DbModels\PaymentRecurring;
use Illuminate\Queue\SerializesModels;

class PaymentRecurringCreatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var PaymentRecurring
     */
    public $paymentRecurring;

    /**
     * Create a new event instance.
     *
     * @param PaymentRecurring $paymentRecurring
     * @param array $options
     */
    public function __construct(PaymentRecurring $paymentRecurring, array $options = [])
    {
        $this->paymentRecurring = $paymentRecurring;
        $this->options = $options;
    }
}
