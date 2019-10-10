<?php

namespace App\Http\Requests\PackageType;

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
            'id' => 'list:numeric',
            'propertyId' => 'list:numeric',
            'title' => 'list:string',
            'icon' => 'list:integer',
        ];
    }
}
