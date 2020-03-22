<?php

namespace App\Http\Requests\TimeClockDevice;

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
            'propertyId'=> 'required',
            'deviceSN' => 'list:string',
            'location' => 'string'
        ];
    }
}
