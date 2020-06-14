<?php

namespace App\Http\Requests\PaymentItemTransaction;

use App\DbModels\PaymentItemTransaction;
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
            'paymentItemId' => 'exists:properties,id',
            'providerName' => 'min:3',
            'providerId' => '',
            'status' => 'in:' . PaymentItemTransaction::STATUS_SUCCESS . ',' . PaymentItemTransaction::STATUS_REJECTED . ',' . PaymentItemTransaction::STATUS_FAILED,
            'rawData' => '',
        ];
    }
}
