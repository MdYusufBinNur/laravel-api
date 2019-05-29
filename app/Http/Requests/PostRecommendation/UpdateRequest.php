<?php

namespace App\Http\Requests\PostRecommendation;

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
            'postId' =>  'exists:posts,id',
            'typeId' =>  'exists:post_recommendation_types,id',
            'name' =>  'min:3|max:100',
            'description' =>  'min:3|max:1024',
            'contact' =>  'min:3|max:191',
            'website' =>  'min:3|max:191',
        ];
    }
}
