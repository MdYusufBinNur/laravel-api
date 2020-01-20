<?php

namespace App\Http\Requests\Visitor;

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
            'signInUserId' => 'list:numeric',
            'unitId' => 'list:numeric',
            'visitorTypeId' => 'list:numeric',
            'phone' => 'list:string',
            'email' => 'list:string',
            'company' => 'list:string',
            'permanent' => 'list:boolean',
            'signature' => 'list:boolean',
            'status' => 'list:string',
            'startDate' => 'date_format:Y-m-d',
            'signInAt' => 'date_format:Y-m-d H:i',
            'endDate' => 'date_format:Y-m-d|after:startDate',
            'withOutPagination' => 'boolean'
        ];
    }
}
