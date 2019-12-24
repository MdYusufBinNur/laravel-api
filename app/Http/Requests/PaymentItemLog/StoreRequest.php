<?php

namespace App\Http\Requests\PaymentItemLog;

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
            'paymentItemId' => 'required|exists:payment_items,id',
            'propertyId' => 'required|exists:properties,id',
            'userId' => 'exists:users,id',
            'unitId' => 'exists:units,id',
            'status' => 'max:255',
            'updatedByUserId' => 'exists:users,id',
        ];
    }
}
