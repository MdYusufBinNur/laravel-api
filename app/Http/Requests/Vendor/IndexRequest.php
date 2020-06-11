<?php

namespace App\Http\Requests\Vendor;

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
            'propertyId' => 'required|numeric',
            'name' => 'string',
            'email' => 'string',
            'phone' => 'string',
            'address' => 'string',
            'website' => 'string',
            'query' => 'string',
            'withOutPagination' => 'boolean'
        ];
    }
}
