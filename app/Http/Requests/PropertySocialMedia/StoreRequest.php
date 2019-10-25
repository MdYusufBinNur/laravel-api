<?php

namespace App\Http\Requests\PropertySocialMedia;

use App\Http\Requests\Request;

class StoreRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'propertyId' => 'required|exists:properties,id',
            'propertySocialMedia' => 'required',
            'propertySocialMedia.*.type' => 'required|in:twitter,facebook,youtube,instagram,other',
            'propertySocialMedia.*.url' => 'required|max:191',
        ];
    }
}
