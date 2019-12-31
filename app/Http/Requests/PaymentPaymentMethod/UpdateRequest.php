<?php

namespace App\Http\Requests\PaymentPaymentMethod;

use App\Http\Requests\Request;

class UpdateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'paymentId' => 'exists:payments,id',
            'paymentMethodId' => 'exists:payment_methods,id'
        ];
    }
}
