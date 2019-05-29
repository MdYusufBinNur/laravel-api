<?php

namespace App\Http\Requests\Package;

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
            'unitId' => 'list:numeric',
            'residentId' => 'list:numeric',
            'typeId' => 'list:numeric',
            'enteredUserId' => 'list:numeric',
            'trackingNumber' => 'list:string',
            'comments' => 'list:string',
            'notifiedByEmail' => 'list:boolean',
            'notifiedByText' => 'list:boolean',
            'notifiedByVoice' => 'list:boolean',
        ];
    }
}