<?php

namespace App\Http\Requests\PaymentInstallment;

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
            'numberOfInstallments' => 'required|numeric',
        ];
    }
}
