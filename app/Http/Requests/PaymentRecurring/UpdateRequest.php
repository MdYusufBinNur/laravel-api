<?php

namespace App\Http\Requests\PaymentRecurring;

use App\DbModels\PaymentRecurring;
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
            'createdByUserId' => 'exists:users,id',
            'propertyId' => 'exists:properties,id',
            'paymentId' => 'exists:payments,id',
            'activationDate' => 'date_format:Y-m-d',
            'expireDate' => 'date_format:Y-m-d',
            'period' => 'in:'.PaymentRecurring::PERIOD_EVERY_DAY.','.PaymentRecurring::PERIOD_EVERY_WEEK.','.PaymentRecurring::PERIOD_EVERY_MONTH.','.PaymentRecurring::PERIOD_EVERY_THREE_MONTHS.','.PaymentRecurring::PERIOD_TWICE_A_YEAR.','.PaymentRecurring::PERIOD_EVERY_YEAR.','.PaymentRecurring::PERIOD_SPECIFIC_DATES,

        ];
    }
}
