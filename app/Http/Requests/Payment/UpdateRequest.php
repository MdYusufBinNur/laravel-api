<?php

namespace App\Http\Requests\Payment;

use App\Http\Requests\Request;
use App\Rules\ListOfIds;

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
            'paymentMethodIds' => [new ListOfIds('payment_methods', 'id')],
            'paymentTypeId' => 'exists:payment_types,id',
            'amount' => 'numeric',
            'note' => 'string',
            'dueDate' => 'date_format:Y-m-d',
            'dueDays' => 'numeric',
            'toUserIds' => [new ListOfIds('users', 'id')],
            'toUnitIds' => [new ListOfIds('units', 'id', ['all_units'])],
            'activationDate' => 'date_format:Y-m-d',
        ];
    }
}
