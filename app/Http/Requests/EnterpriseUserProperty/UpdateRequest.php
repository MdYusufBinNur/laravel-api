<?php

namespace App\Http\Requests\EnterpriseUserProperty;

use App\Http\Requests\Request;

class UpdateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'enterpriseUserId' =>  'exists:enterprise_users,id',
            'propertyId' =>  'exists:properties,id',
            'active' =>  'boolean',
        ];
    }
}
