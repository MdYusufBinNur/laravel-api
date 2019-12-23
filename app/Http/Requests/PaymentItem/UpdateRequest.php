<?php

namespace App\Http\Requests\PaymentItem;

use App\DbModels\PaymentItem;
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
            'createdByUserId' => 'exists:user,id',
            'paymentId' => 'exists:payments,id',
            'userId' => 'exists:users,id',
            'unitId' => 'exists:units,id',
            'status' => 'in:'.PaymentItem::STATUS_PAID.','.PaymentItem::STATUS_PENDING.','.PaymentItem::STATUS_CANCELLED,
        ];
    }
}
