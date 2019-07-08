<?php

namespace App\Http\Requests\User;

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
        return $rules = [
            'email' => 'email|required|unique:users',
            'name' => 'max:100',
            'password' => 'required|min:5',
            'locale' => '',
            'isActive' => 'boolean',
            'roles' => '',
            'roles.roleId' => 'required|exists:roles,id',
            'roles.propertyId' => 'required|exists:properties,id'
        ];
    }

}
