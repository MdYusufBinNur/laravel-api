<?php

namespace App\Http\Requests\PaymentPublishLog;

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
            'paymentId' => 'exists:payments,id',
            'propertyId' => 'exists:properties,id'
        ];
    }
}
