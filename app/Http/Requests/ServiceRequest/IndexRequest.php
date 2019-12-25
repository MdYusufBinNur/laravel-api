<?php

namespace App\Http\Requests\ServiceRequest;

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
            'userId' => 'list:numeric',
            'unitId' => 'list:numeric',
            'categoryId' => 'list:numeric',
            'status' => 'list:string',
            'phone' => 'list:string',
            'description' => 'list:text',
            'permissionToEnter' => 'list:boolean',
            'preferredStartTime' => 'list:time',
            'preferredEndTime' => 'list:time',
            'feedback' => 'list:string',
            'photo' => 'list:boolean',
            'resolvedAt' => 'list:date',
            'startDate' => 'date_format:Y-m-d',
            'endDate' => 'date_format:Y-m-d',
        ];
    }
}
