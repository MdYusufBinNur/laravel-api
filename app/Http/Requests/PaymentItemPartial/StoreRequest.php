<?php

namespace App\Http\Requests\PaymentItemPartial;

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
            'propertyId' => 'required|exists:properties,id',
            'paymentMethodId' => 'exists:payment_methods,id',
            'paymentItemId' => 'exists:payment_items,id',
            'paymentDate' => 'date_format:Y-m-d',
            'amount' => 'numeric'
        ];
    }
}
