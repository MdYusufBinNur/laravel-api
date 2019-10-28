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
<<<<<<< HEAD
            'propertySocialMedia.*.url' => 'required|min:10|max:255',
=======
            'propertySocialMedia.*.url' => 'required|max:191',
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d
        ];
    }
}
