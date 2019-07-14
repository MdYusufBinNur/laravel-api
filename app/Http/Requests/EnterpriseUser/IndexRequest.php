<?php

namespace App\Http\Requests\EnterpriseUser;

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
            'userId' =>  'list:numeric',
            'companyId' =>  'list:numeric',
            'contactEmail' =>  'list:string',
            'phone' =>  'list:string',
            'title' =>  'list:string',
            'level' =>  'list:string',
        ];
    }
}
