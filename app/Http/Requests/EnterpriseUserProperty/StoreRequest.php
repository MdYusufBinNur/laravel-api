<?php

namespace App\Http\Requests\EnterpriseUserProperty;

use App\Http\Requests\Request;

class StoreRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'enterpriseUserId' =>  'required|exists:enterprise_users,id',
            'propertyId' =>  'required|exists:properties,id',
            'active' =>  'boolean',
        ];
    }
}
