<?php

namespace App\Http\Requests\Unit;

use App\Http\Requests\Request;

class FloorListAutoCompleteRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $rules = [
            'propertyId' => 'required',
            'towerId' => 'numeric',
            'query' => 'string'
        ];
    }
}
