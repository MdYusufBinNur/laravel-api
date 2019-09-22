<?php

namespace App\Http\Requests\LdsSetting;

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
            'propertyId' => 'list:numeric',
            'refreshRate' => 'integer',
            'showPackages' => 'boolean',
            'iconSize' => 'list:string',
            'iconColor' => 'list:string',
            'theme' => 'list:string',
        ];
    }
}
