<?php

namespace App\Http\Requests\PaymentRecurring;

use App\DbModels\PaymentRecurring;
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
            'period' => 'required|in:'.PaymentRecurring::PERIOD_EVERY_DAY.','.PaymentRecurring::PERIOD_EVERY_WEEK.','.PaymentRecurring::PERIOD_EVERY_MONTH.','.PaymentRecurring::PERIOD_EVERY_THREE_MONTHS.','.PaymentRecurring::PERIOD_TWICE_A_YEAR.','.PaymentRecurring::PERIOD_EVERY_YEAR.','.PaymentRecurring::PERIOD_SPECIFIC_DATES,
        ];
    }
}
