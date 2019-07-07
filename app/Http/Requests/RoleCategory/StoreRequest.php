<?php

namespace App\Http\Requests\RoleCategory;

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
        return [
            'category' => 'required|min:3|max:100',
        ];
    }
}
