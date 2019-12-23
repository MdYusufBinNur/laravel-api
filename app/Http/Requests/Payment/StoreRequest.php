<?php

namespace App\Http\Requests\Payment;

use App\DbModels\Payment;
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
            'createdByUserId' => 'exists:users,id',
            'propertyId' => 'required|exists:properties,id',
            'paymentMethodId' => 'required|exists:payment_methods,id',
            'paymentTypeId' => 'required|exists:payment_types,id',
            'amount' => 'required',
            'note' => 'required',
            'dueDate' => 'required|date_format:Y-m-d',
            'dueDays' => 'numeric',
            'isRecurring' => 'boolean',
            'status' => 'required|id:'.Payment::STATUS_PENDING.','.Payment::STATUS_DONE.','.Payment::STATUS_NOT_ACTIVATED.','.Payment::STATUS_PARTIALLY_DONE,
            'activationDate' => 'required|date_format:Y-m-d',
        ];
    }
}
