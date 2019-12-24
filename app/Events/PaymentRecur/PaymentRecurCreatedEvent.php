<?php

namespace App\Events\PaymentRecur;

use App\DbModels\PaymentRecur;
use Illuminate\Queue\SerializesModels;

class PaymentRecurCreatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var PaymentRecur
     */
    public $paymentRecur;

    /**
     * Create a new event instance.
     *
     * @param PaymentRecur $paymentRecur
     * @param array $options
     */
    public function __construct(PaymentRecur $paymentRecur, array $options = [])
    {
        $this->paymentRecur = $paymentRecur;
        $this->options = $options;
    }
}
