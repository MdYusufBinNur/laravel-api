<?php

namespace App\Http\Requests\EnterpriseUser;

use App\DbModels\EnterpriseUser;
use App\Http\Requests\Request;
use App\Rules\PropertyForCompanyAllowed;

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
            'userId' => 'exists:users,id',
            'companyId' => 'required_with:propertyIds|exists:companies,id',
            'contactEmail' => 'email|max:255',
            'phone' => 'min:12|max:20',
            'title' => 'min:3|max:255',
            'propertyIds' => [new PropertyForCompanyAllowed($this->get('companyId'))],
            'level' => 'in:' . EnterpriseUser::LEVEL_ADMIN . ',' . EnterpriseUser::LEVEL_STANDARD,
        ];
    }
}
