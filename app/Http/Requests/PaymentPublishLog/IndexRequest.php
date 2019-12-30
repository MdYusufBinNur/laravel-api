<?php

namespace App\Http\Requests\PaymentPublishLog;

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
            'paymentId' => 'list:numeric',
            'propertyId' => 'list:numeric',
        ];
    }
}
