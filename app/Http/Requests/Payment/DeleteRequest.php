<?php

namespace App\Http\Requests\Payment;

use App\Http\Requests\Request;

class DeleteRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'confirm' => 'required|in:1'

        ];
    }
}
