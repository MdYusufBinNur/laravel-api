<?php

namespace App\Http\Requests\PropertyImage;

use App\DbModels\PropertyImage;
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
            'propertyId' =>  'required|exists:properties,id',
            'type' =>  'required|in:'
                . PropertyImage::TYPE_BANNER . ','
                . PropertyImage::TYPE_LOGO . ','
                . PropertyImage::TYPE_GALLERY,
            'title' =>  'max:191',
            'imageId' =>  'required|exists:attachments,id',
        ];
    }
}
