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
            'postId' => 'required_without:post|exists:posts,id',
            'typeId' => 'required|exists:post_recommendation_types,id',
            'name' => 'required|max:191',
            'description' => 'string',
            'contact' => 'min:3|max:191',
            'website' => 'min:3|max:191',

            'post' => '',
            'post.propertyId' => 'required_with:post|exists:properties,id',
            'post.attachmentIds' => 'json|json_ids:attachments,id',
        ];
    }
}
