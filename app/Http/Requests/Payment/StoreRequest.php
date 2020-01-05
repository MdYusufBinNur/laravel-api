<?php

namespace App\Http\Requests\Payment;

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
            'paymentMethodIds' => ['required', new ListOfIds('payment_methods', 'id')], //todo rule for only this propertyId
            'paymentTypeId' => 'required|exists:payment_types,id',
            'amount' => 'required',
            'note' => 'string',
            'dueDate' => 'required_without:dueDays|date_format:Y-m-d',
            'dueDays' => 'required_without:dueDate|numeric',
            'isRecurring' => 'boolean',
            'toUserIds' => ['required_without:toUnitIds', new ListOfIds('users', 'id')],
            'toUnitIds' => ['required_without:toUserIds', new ListOfIds('units', 'id', ['all_units'])],
            'activationDate' => 'date_format:Y-m-d',
            'expireDate' => 'required_if:isRecurring,1' . '|date_format:Y-m-d',
            'period' => 'required_if:isRecurring,1' .'|in:'. implode(',', PaymentRecurring::getConstantsByPrefix('PERIOD_')),
        ];
    }
}
