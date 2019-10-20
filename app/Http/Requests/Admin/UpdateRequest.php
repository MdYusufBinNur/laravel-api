<?php

namespace App\Http\Requests\Admin;

use App\DbModels\Admin;
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
        return [
            'level' =>  'in:'.Admin::LEVEL_ADMIN.','.Admin::LEVEL_LIMITED.','.Admin::LEVEL_STANDARD,
            'users' => '',
            'users.name' => 'min:3|max:100',
            'users.isActive' => 'boolean',
        ];
    }
}
