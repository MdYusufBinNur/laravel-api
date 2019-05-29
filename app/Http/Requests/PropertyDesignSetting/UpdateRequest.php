<?php

namespace App\Http\Requests\PropertyDesignSetting;

use App\Http\Requests\Request;

class UpdateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'propertyId' => 'exists:properties,id',
            'themeId' => 'integer',
            'selectedBackground' => 'min:3|max:191',
            'selectedHeadline' => 'min:3|max:191',
            'customImage' => 'min:3|max:191',
            'tileUploadedImage' => 'boolean',
        ];
    }
}
