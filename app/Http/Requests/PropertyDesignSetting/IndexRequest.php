<?php

namespace App\Http\Requests\PropertyDesignSetting;

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
            'themeId' => 'list:integer',
            'selectedBackground' => 'list:string',
            'selectedHeadline' => 'list:string',
            'tileUploadedImage' => 'list:boolean',
        ];
    }
}
