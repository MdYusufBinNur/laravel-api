<?php

namespace App\Http\Requests\ModuleOption;

use App\Http\Requests\Request;

class IndexRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'        => 'list:numeric',
            'moduleId'  => 'list:numeric',
            'key'       => 'list:string',
        ];
    }
}
