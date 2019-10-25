<?php

namespace App\Http\Requests\ModuleOption;

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
            'moduleId'      => 'numeric|exists:modules,id',
            'key'           => 'max:191',
            'title'         => 'max:191',
        ];
    }
}
