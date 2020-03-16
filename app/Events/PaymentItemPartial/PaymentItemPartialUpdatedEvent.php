<?php

namespace App\Events\PaymentItemPartial;

use App\DbModels\PaymentItemPartial;
use Illuminate\Queue\SerializesModels;

class PaymentItemPartialUpdatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var PaymentItemPartial
     */
    public $paymentItemPartial;

    /**
     * Create a new event instance.
     *
     * @param PaymentItemPartial $paymentItemPartial
     * @param array $options
     */
    public function __construct(PaymentItemPartial $paymentItemPartial, array $options = [])
    {
        $this->paymentItemPartial = $paymentItemPartial;
        $this->options = $options;
    }

}
