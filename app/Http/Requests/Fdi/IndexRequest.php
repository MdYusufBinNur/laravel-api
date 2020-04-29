<?php

namespace App\Http\Requests\Fdi;

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
            'propertyId' => 'required|list:numeric',
            'userId' => 'list:numeric',
            'unitId' => 'list:numeric',
            'type' => 'list:string',
            'guestTypeId' => 'list:string',
            'name' => 'list:string',
            'startDate' => 'date_format:Y-m-d',
            'endDate' => 'date_format:Y-m-d',
            'canGetKey' => 'boolean',
            'signature' => 'boolean',
            'permanent' => 'boolean',
            'status' => 'list:string',
            'withOutPagination' => 'boolean',
        ];
    }
}
