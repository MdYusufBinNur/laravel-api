<?php

namespace App\Http\Requests\PaymentItemTransaction;

use App\DbModels\PaymentItemTransaction;
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
            'paymentItemId' => 'required|exists:properties,id',
            'providerName' => 'required|min:3',
            'providerId' => 'required',
            'status' => 'required|in:' . PaymentItemTransaction::STATUS_SUCCESS . ',' . PaymentItemTransaction::STATUS_REJECTED . ',' . PaymentItemTransaction::STATUS_FAILED,
            'rawData' => '',
        ];
    }
}
