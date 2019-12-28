<?php

namespace App\Http\Requests\Payment;

use App\DbModels\Payment;
use App\DbModels\PaymentRecurring;
use App\Http\Requests\Request;
use App\Rules\ListOfIds;

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
            'paymentMethodId' => 'required|exists:payment_methods,id',
            'paymentTypeId' => 'required|exists:payment_types,id',
            'amount' => 'required',
            'note' => 'required',
            'dueDate' => 'required_without:dueDays|date_format:Y-m-d',
            'dueDays' => 'required_without:dueDays|numeric',
            'isRecurring' => 'boolean',
            'toUserIds' => [new ListOfIds('users', 'id')],
            'toUnitIds' => [new ListOfIds('units', 'id', ['all_units'])],
            'activationDate' => 'date_format:Y-m-d',
            'expireDate' => 'required_if:isRecurring,1' . '|date_format:Y-m-d',
            'period' => 'required_if:isRecurring,1' .'|in:'. implode(',', PaymentRecurring::getConstantsByPrefix('PERIOD_')),
        ];
    }
}
