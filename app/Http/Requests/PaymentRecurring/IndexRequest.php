<?php

namespace App\Http\Requests\PaymentRecurring;

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
            'paymentId' => 'list:numeric',
            'activationDate' => 'date_format:Y-m-d',
            'expireDate' => 'date_format:Y-m-d',
            'period' => 'list:string',
        ];
    }
}
