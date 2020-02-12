<?php

namespace App\Http\Requests\LdsSlide;

use App\DbModels\LdsSlide;
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
            'propertyId' => 'required',
            'title' => 'required|max:255',
            'backgroundColor' => 'max:20',
            'type' => 'in:' . LdsSlide::TYPE_CUSTOM . ',' . LdsSlide::TYPE_STANDARD,
            'imageId' => 'unique:lds_slides,imageId,required|exists:attachments,id',
        ];
    }
}
