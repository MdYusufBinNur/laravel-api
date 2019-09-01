<?php

namespace App\Http\Requests\ResidentAccessRequest;

use App\Http\Requests\Request;

class GetByPinRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'pin' => 'required|string'
        ];
    }
}
