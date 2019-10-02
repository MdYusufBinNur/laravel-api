<?php

namespace App\Http\Requests\Unit;

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
        return $rules = [
            'towerId'   => 'exists:towers,id',
            'propertyId'   => 'exists:properties,id',
            'title'     => 'min:2|max:50',
            'floor'     => 'max:50',
            'line'      => 'max:50',
        ];
    }

}
