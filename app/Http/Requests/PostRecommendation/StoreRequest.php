<?php

namespace App\Http\Requests\PostRecommendation;

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
            'postId' =>  'required|exists:posts,id',
            'typeId' =>  'required|exists:post_recommendation_types,id',
            'name' =>  'required|min:3|max:100',
            'description' =>  'min:3|max:1024',
            'contact' =>  'min:3|max:191',
            'website' =>  'min:3|max:191',
        ];
    }
}
