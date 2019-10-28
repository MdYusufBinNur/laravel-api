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
<<<<<<< HEAD
            'title' =>  'min:3|max:255',
=======
            'title' =>  'max:191',
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d
            'imageId' =>  'required|exists:attachments,id',
        ];
    }
}
