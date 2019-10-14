<?php

namespace App\Http\Requests\UserPropertyResident;

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
            'unitId' => 'list:numeric',
            'role' => 'list:string',
            'groups' => 'list:string',
            'displayUnit' => 'boolean',
            'displayPublicProfile' => 'boolean',
            'allowPostNote' => 'boolean',
        ];
    }
}
