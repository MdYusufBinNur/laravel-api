<?php

namespace App\Http\Requests\PaymentPaymentMethod;

use App\Http\Requests\Request;

class StoreRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'paymentId' => 'required|exists:payments,id',
            'paymentMethodId' => 'required|exists:payment_methods,id'
        ];
    }
}
