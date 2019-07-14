<?php

namespace App\Http\Requests\EnterpriseUser;

use App\DbModels\EnterpriseUser;
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
            'userId' =>  'exists:users,id',
            'companyId' =>  'exists:companies,id',
            'contactEmail' =>  'email',
            'phone' =>  'min:12|max:20',
            'title' =>  'min:3|max:512',
            'propertyId' => 'nullable|exists:properties,id',
            'level' =>  'in:'.EnterpriseUser::LEVEL_ADMIN.','.EnterpriseUser::LEVEL_STANDARD,
        ];
    }
}
