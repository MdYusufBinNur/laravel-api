<?php

namespace App\Http\Requests\PaymentItemLog;

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
            'paymentItemId' => 'required|numeric',
            'propertyId' => 'required|numeric',
            'userId' => 'list:numeric',
            'unitId' => 'list:numeric',
            'status' => 'list:string',
            'updatedByUserId' => 'list:numeric',
        ];
    }
}
