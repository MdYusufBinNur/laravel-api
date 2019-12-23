<?php

namespace App\Http\Requests\Payment;

use App\DbModels\Payment;
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
            'propertyId' => 'exists:properties,id',
            'paymentMethodId' => 'exists:payment_methods,id',
            'paymentTypeId' => 'exists:payment_types,id',
            'amount' => '',
            'note' => '',
            'dueDate' => 'date_format:Y-m-d',
            'dueDays' => 'numeric',
            'isRecurring' => 'boolean',
            'status' => 'id:'.Payment::STATUS_PENDING.','.Payment::STATUS_DONE.','.Payment::STATUS_NOT_ACTIVATED.','.Payment::STATUS_PARTIALLY_DONE,
            'activationDate' => 'date_format:Y-m-d',
        ];
    }
}
