<?php

namespace App\Http\Requests\ResidentEmergency;

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
            'residentId' => 'list:numeric',
            'name' => 'list:string',
            'relationship' => 'list:string',
            'address' => 'list:string',
            'homePhone' => 'list:string',
            'cellPhone' => 'list:string',
            'email' => 'list:string',
        ];
    }
}
