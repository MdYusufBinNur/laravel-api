<?php

namespace App\Http\Requests\PaymentItemTransaction;

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
            'paymentItemId' => 'required|exists:payment_items,id',
            'sourceURL' => 'required|max:255',
            'providerName' => 'min:3'
        ];
    }
}
