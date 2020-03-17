<?php

namespace App\Http\Requests\PaymentInstallmentItem;

use App\Http\Requests\Request;

class IndexRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'list:numeric',
            'createdByUserId' => 'list:numeric',
            'propertyId' => 'list:numeric',
            'paymentInstallmentId' => 'list:numeric',
            'dueDate' => 'date_format:Y-m-d',
            'amount' => '',
        ];
    }
}
