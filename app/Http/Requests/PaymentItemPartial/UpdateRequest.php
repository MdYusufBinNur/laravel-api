<?php

namespace App\Http\Requests\PaymentItemPartial;

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
            'paymentMethodId' => 'exists:payment_methods,id',
            'paymentDate' => 'date_format:Y-m-d',
            'amount' => 'max:6',
            'note' => 'string|max:65535'
        ];
    }
}
