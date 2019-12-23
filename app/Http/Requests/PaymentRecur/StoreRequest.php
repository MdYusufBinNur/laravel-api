<?php

namespace App\Http\Requests\PaymentRecur;

use App\DbModels\PaymentRecur;
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
            'paymentId' => 'required|exists:payments,id',
            'activationDate' => 'required|date_format:Y-m-d',
            'expireDate' => 'required|date_format:Y-m-d',
            'period' => 'required|in:'.PaymentRecur::PERIOD_EVERY_DAY.','.PaymentRecur::PERIOD_EVERY_WEEK.','.PaymentRecur::PERIOD_EVERY_MONTH.','.PaymentRecur::PERIOD_EVERY_THREE_MONTHS.','.PaymentRecur::PERIOD_TWICE_A_YEAR.','.PaymentRecur::PERIOD_EVERY_YEAR.','.PaymentRecur::PERIOD_SPECIFIC_DATES,
        ];
    }
}
