<?php

namespace App\Http\Requests\EnterpriseUser;

use App\DbModels\EnterpriseUser;
use App\Http\Requests\Request;
use App\Rules\ListOfIds;
use Illuminate\Support\Facades\DB;
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
        return [
            'userId' => 'exists:users,id',
            'companyId' => 'exists:companies,id',
            'contactEmail' => 'email',
            'phone' => 'min:12|max:20',
            'title' => 'min:3|max:512',
            'propertyIds' => [new ListOfIds('properties', 'id')],
            'level' => 'in:' . EnterpriseUser::LEVEL_ADMIN . ',' . EnterpriseUser::LEVEL_STANDARD,
        ];
    }
}
