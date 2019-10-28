<?php

namespace App\Http\Requests\EnterpriseUser;

use App\DbModels\EnterpriseUser;
use App\Http\Requests\Request;
use App\Rules\ListOfIds;

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
            'userId' =>  'required_without:users|exists:users,id',
            'companyId' =>  'required|exists:companies,id',
<<<<<<< HEAD
            'contactEmail' =>  'email|max:255',
            'phone' =>  'min:12|max:20',
            'title' =>  'min:3|max:255',
=======
            'contactEmail' =>  'email',
            'phone' =>  'max:20',
            'title' =>  'max:512',
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d
            'propertyIds' => [new ListOfIds('properties', 'id')],
            'level' =>  'in:'.EnterpriseUser::LEVEL_ADMIN.','.EnterpriseUser::LEVEL_STANDARD,
            'users' => 'required_without:userId',
            'users.name' => 'required_without:userId|min:3|max:255',
            'users.email' => 'required_without:userId|email|unique:users|max:255',
            'users.password' => 'required_without:userId|min:5|max:255',
        ];
    }
}
