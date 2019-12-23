<?php

namespace App\Http\Requests\PaymentItemLog;

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
            'paymentItemId' => 'exists:payment_items,id',
            'userId' => 'exists:users,id',
            'unitId' => 'exists:units,id',
            'status' => 'max:255',
            'updatedByUserId' => 'exists:users,id',
        ];
    }
}
