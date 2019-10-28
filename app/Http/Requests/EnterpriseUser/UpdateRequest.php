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
<<<<<<< HEAD
            'contactEmail' => 'email|max:255',
            'phone' => 'min:12|max:20',
            'title' => 'min:3|max:255',
=======
            'contactEmail' => 'email',
            'phone' => 'min:7|max:20',
            'title' => 'max:512',
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d
            'propertyIds' => [new ListOfIds('properties', 'id')],
            'level' => 'in:' . EnterpriseUser::LEVEL_ADMIN . ',' . EnterpriseUser::LEVEL_STANDARD,
        ];
    }
}
