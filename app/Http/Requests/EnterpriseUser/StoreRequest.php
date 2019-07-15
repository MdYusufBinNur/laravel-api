<?php

namespace App\Http\Requests\EnterpriseUser;

use App\DbModels\EnterpriseUser;
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
            'userId' =>  'exists:users,id',
            'companyId' =>  'required|exists:companies,id',
            'contactEmail' =>  'email',
            'phone' =>  'min:12|max:20',
            'title' =>  'min:3|max:512',
            'propertyId' => 'nullable|exists:properties,id',
            'level' =>  'in:'.EnterpriseUser::LEVEL_ADMIN.','.EnterpriseUser::LEVEL_STANDARD,
            'users' => 'required_without:userId',
            'users.name' => 'required_without:userId|min:3|max:100',
            'users.email' => 'required_without:userId|email|unique:users',
            'users.password' => 'required_without:userId|min:5',
        ];
    }
}
