<?php

namespace App\Http\Requests\PaymentInstallmentItem;

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
            'paymentInstallmentId' => 'required|exists:payment_installments,id',
            'dueDate' => 'date_format:Y-m-d',
            'amount' => 'required',
        ];
    }
}
