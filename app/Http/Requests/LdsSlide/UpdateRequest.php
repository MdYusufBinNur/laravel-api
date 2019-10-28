<?php

namespace App\Http\Requests\LdsSlide;

use App\DbModels\LdsSlide;
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
        $ldsSlideId = $this->segment(4);
        return [
<<<<<<< HEAD
            'title' => 'min:3|max:255',
=======
            'title' => 'max:1024',
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d
            'backgroundColor' => 'max:20',
            'type' => 'in:' . LdsSlide::TYPE_CUSTOM . ',' . LdsSlide::TYPE_STANDARD,
            'imageId' => 'exists:attachments,id|unique:lds_slides,imageId,' . $ldsSlideId,
        ];
    }
}
