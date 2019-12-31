<?php


namespace App\Repositories;


use App\DbModels\Payment;
use App\Repositories\Contracts\PaymentPaymentMethodRepository;
use Illuminate\Support\Collection;

class EloquentPaymentPaymentMethodRepository extends EloquentBaseRepository implements PaymentPaymentMethodRepository
{
    /**
     * @inheritDoc
     */
    public function setPaymentMethods(Payment $payment, array $methodIds): \ArrayAccess
    {
        $paymentPaymentMethods = $payment->paymentPaymentMethods;
        if ($paymentPaymentMethods) {
            foreach ($paymentPaymentMethods as $paymentPaymentMethod) {
                $this->delete($paymentPaymentMethod);
            }
        }


        foreach ($methodIds as $methodId) {
            $data = ['paymentId' => $payment->id, 'paymentMethodId' => $methodId];
            $this->patch($data, $data);
        }

        return new Collection();
    }
}
