<?php

namespace App\Http\Requests\Company;

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
            'id'        => 'list:numeric',
            'title'     => 'list:string',
            'city'      => 'list:string',
            'state'     => 'list:string',
            'postCode' => 'list:string',
            'active'    => 'list:string',
            'query'    => 'string',
        ];
    }

}
