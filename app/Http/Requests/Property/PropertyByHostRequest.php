<?php

namespace App\Http\Requests\Property;

use App\Http\Requests\Request;

class PropertyByHostRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $rules = [
            'host'       => 'required'
        ];
    }

}
