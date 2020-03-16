<?php

namespace App\Http\Requests\PaymentItemPartial;

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
            'propertyId' => 'required|numeric',
            'paymentMethodId' => 'list:numeric',
            'paymentItemId' => 'list:numeric',
            'paymentDate' => 'date_format:Y-m-d',
        ];
    }
}
