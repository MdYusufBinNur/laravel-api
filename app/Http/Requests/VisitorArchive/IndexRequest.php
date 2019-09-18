<?php

namespace App\Http\Requests\VisitorArchive;

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
            'visitorId' => 'list:numeric',
            'signOutUserId' => 'list:numeric',
            'signature' => 'list:boolean',
            'startDate' => 'date',
            'endDate' => 'date|after:startDate',
            'unitId' => '',
        ];
    }
}
