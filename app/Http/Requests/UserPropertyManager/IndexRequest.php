<?php

namespace App\Http\Requests\UserPropertyManager;

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
            'userId' => 'list:numeric',
            'propertyId' => 'list:numeric',
            'role' => 'list:string',
            'title' => 'list:string',
            'phone' => 'list:string',
            'displayInCorner' => 'boolean',
            'displayPublicProfile' => 'boolean',
        ];
    }
}
