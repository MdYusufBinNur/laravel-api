<?php

namespace App\Http\Requests\EnterpriseUserProperty;

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
            'createdByUserId' =>  'list:numeric',
            'enterpriseUserId' =>  'list:numeric',
            'propertyId' =>  'list:numeric',
            'active' =>  'boolean',
        ];
    }
}
