<?php

namespace App\Http\Requests\Property;

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
            'id'         => 'list:numeric',
            'companyId' => 'list:numeric',
            'type'       => 'list:string',
            'title'      => 'list:string',
            'subdomain'  => 'list:string',
            'address'    => 'list:string',
            'city'       => 'list:string',
            'state'      => 'list:string',
            'postCode'  => 'list:string',
            'country'    => 'list:string',
            'language'   => 'list:string',
            'timezone'   => 'list:string',
            'active'     => 'list:numeric',
        ];
    }

}
