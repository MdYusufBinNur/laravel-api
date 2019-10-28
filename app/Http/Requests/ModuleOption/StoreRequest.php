<?php

namespace App\Http\Requests\ModuleOption;

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
            'moduleId'      => 'numeric|exists:modules,id',
            'key'           => 'required|min:5|max:255',
            'title'         => 'required|min:5|max:255',
        ];
    }
}
