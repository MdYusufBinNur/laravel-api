<?php

namespace App\Http\Requests\PostRecommendationType;

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
            'title' =>  'min:5|max:191',
        ];
    }
}