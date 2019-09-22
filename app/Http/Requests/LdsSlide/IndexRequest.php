<?php

namespace App\Http\Requests\LdsSlide;

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
            'title' => 'list:string',
            'backgroundColor' => 'list:string',
            'type' => 'list:string',
            'imageId' => 'list:numeric',
        ];
    }
}
