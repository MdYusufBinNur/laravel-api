<?php

namespace App\Http\Requests\Unit;

use App\Http\Requests\Request;

class StoreRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $rules = [
            'towerId'      => 'exists:towers,id',
            'propertyId'   => 'required|exists:properties,id',
            'title'        => 'required|min:2|max:50',
            'floor'        => 'max:50',
            'line'         => 'max:50',
        ];
    }
}
