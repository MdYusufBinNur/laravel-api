<?php

namespace App\Http\Requests\PaymentItem;

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
            'paymentId' => 'list:numeric',
            'userId' => 'list:numeric',
            'unitId' => 'list:numeric',
            'status' => 'list:string',
        ];
    }
}
