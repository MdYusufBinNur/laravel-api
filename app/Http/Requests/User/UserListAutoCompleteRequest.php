<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Request;

class UserListAutoCompleteRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $rules = [
            'propertyId' => 'required',
            'query' => 'required|string'
        ];
    }
}
