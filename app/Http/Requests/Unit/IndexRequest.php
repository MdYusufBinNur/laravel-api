<?php

namespace App\Http\Requests\Unit;

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
        return $rules = [
            'id'           => 'list:numeric',
            'towerId'      => 'list:numeric',
            'propertyId'   => 'required|numeric',
            'title'        => 'list:string',
            'floor'        => 'list:string',
            'line'         => 'list:string',
        ];
    }

}
