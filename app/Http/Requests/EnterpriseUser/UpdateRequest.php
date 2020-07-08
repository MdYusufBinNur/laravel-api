<?php

namespace App\Http\Requests\EnterpriseUser;

use App\DbModels\EnterpriseUser;
use App\Http\Requests\Request;
use App\Rules\PropertyForCompanyAllowed;
use Illuminate\Validation\Rule;

class UpdateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $userId = $this->segment(4);
        return [
            'userId' => 'exists:users,id',
            'companyId' => 'required_with:propertyIds|exists:companies,id',
            'contactEmail' => 'email|max:255',
            'phone' => 'phone:BD',
            'title' => 'max:255',
            'propertyIds' => [new PropertyForCompanyAllowed($this->get('companyId'))],
            'level' => 'in:' . EnterpriseUser::LEVEL_ADMIN . ',' . EnterpriseUser::LEVEL_STANDARD,

            'users'                 => '',
            'users.name'            => 'min:3|max:255',
            'users.email'           => Rule::unique('users')->ignore($userId, 'id'),
            'users.isActive'        => 'boolean',
        ];
    }
}
