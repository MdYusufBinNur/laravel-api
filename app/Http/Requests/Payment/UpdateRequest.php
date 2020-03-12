<?php

namespace App\Http\Requests\Payment;

use App\DbModels\PaymentRecurring;
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
            'note' => '',
            'billingInfo' => '',
            'dueDate' => 'date_format:Y-m-d',
            'dueDays' => 'numeric',
            'toUserIds' => [new ListOfIds('users', 'id')],
            'toUnitIds' => [new ListOfIds('units', 'id', ['all_units'])],
            'toVendorIds' => [new ListOfIds('vendors', 'id')],
            'toCustomerIds' => [new ListOfIds('customers', 'id')],
            'activationDate' => 'date_format:Y-m-d',
            'isRecurring' => 'boolean',
            'expireDate' => 'required_if:isRecurring,1' . '|date_format:Y-m-d',
            'period' => 'required_if:isRecurring,1' .'|in:'. implode(',', PaymentRecurring::getConstantsByPrefix('PERIOD_')),

        ];
    }
}
