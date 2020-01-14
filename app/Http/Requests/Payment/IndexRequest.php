<?php

namespace App\Http\Requests\Payment;

use App\Http\Requests\Request;

class IndexRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'list:numeric',
            'createdByUserId' => 'list:numeric',
            'propertyId' => 'required|numeric',
            'toUserIds' => 'numeric',
            'toUnitIds' => 'numeric',
            'paymentMethodIds' => 'list:numeric',
            'paymentTypeId' => 'list:numeric',
            'amount' => '',
            'dueDate' => 'date_format:Y-m-d',
            'dueDays' => 'numeric',
            'isRecurring' => 'boolean',
            'status' => 'list:string',
            'activationDate' => 'date_format:Y-m-d',
        ];
    }
}
