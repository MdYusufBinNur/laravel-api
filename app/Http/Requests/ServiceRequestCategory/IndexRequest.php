<?php

namespace App\Http\Requests\ServiceRequestCategory;

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
            'parentId' => 'list:numeric',
            'title' => 'list:string',
            'type' => 'list:string',
            'active' => 'list:boolean',
        ];
    }
}
