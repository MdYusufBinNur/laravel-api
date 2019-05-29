<?php

namespace App\Http\Requests\ServiceRequestLog;

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
            'serviceRequestId' => 'list:numeric',
            'userId' => 'list:numeric',
            'type' => 'list:string',
            'feedback' => 'list:string',
            'status' => 'list:boolean',
        ];
    }
}
