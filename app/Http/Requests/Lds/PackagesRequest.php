<?php

namespace App\Http\Requests\Lds;

use App\Http\Requests\Request;

class PackagesRequest extends Request
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
            'propertyId' => 'required|numeric'
        ];
    }
}
