<?php

namespace App\Http\Requests\PropertyGeneralInfo;

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
            'propertyId' => 'list:numeric',
            'officeHours' => 'list:string',
            'phone' => 'list:string',
            'emergenceContact' => 'list:string',
            'email' => 'list:string',
        ];
    }
}
