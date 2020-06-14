<?php

namespace App\Events\PaymentItemTransaction;

use App\DbModels\PaymentItemTransaction;
use Illuminate\Queue\SerializesModels;

class PaymentItemTransactionUpdatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var $paymentItemTransaction
     */
    public $paymentItemTransaction;

    /**
     * Create a new event instance.
     *
     * @param PaymentItemTransaction $paymentItemTransaction
     * @param array $options
     */
    public function __construct(PaymentItemTransaction $paymentItemTransaction, array $options = [])
    {
        $this->paymentItemTransaction = $paymentItemTransaction;
        $this->options = $options;
    }
}
