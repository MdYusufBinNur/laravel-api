<?php

namespace App\Http\Requests\Role;

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
        return $rules = [
            'title'             => 'min:3',
            'roleCategoryId'    => 'exists:role_categories,id',
        ];
    }

}
