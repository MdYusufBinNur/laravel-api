<?php

namespace App\Http\Requests\PaymentRecur;

use App\DbModels\PaymentRecur;
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
            'period' => 'in:'.PaymentRecur::PERIOD_EVERY_DAY.','.PaymentRecur::PERIOD_EVERY_WEEK.','.PaymentRecur::PERIOD_EVERY_MONTH.','.PaymentRecur::PERIOD_EVERY_THREE_MONTHS.','.PaymentRecur::PERIOD_TWICE_A_YEAR.','.PaymentRecur::PERIOD_EVERY_YEAR.','.PaymentRecur::PERIOD_SPECIFIC_DATES,

        ];
    }
}
