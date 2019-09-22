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
        return [
            'title' => 'min:3|max:1024',
            'backgroundColor' => 'max:20',
            'type' => 'in:'.LdsSlide::TYPE_CUSTOM.','.LdsSlide::TYPE_STANDARD,
            'imageId' => '',
        ];
    }
}
