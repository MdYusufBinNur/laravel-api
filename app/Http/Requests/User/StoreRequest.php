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
            'email' => 'email|required|unique:users||max:255',
            'name' => 'max:255',
            'password' => 'required|min:5||max:255',
            'locale' => '|max:255',
            'isActive' => 'boolean',
            'role' => '',
            'role.roleId' => 'required|exists:roles,id',
            'role.propertyId' => 'nullable|exists:properties,id'
        ];
    }

}
