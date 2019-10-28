<?php

namespace App\Http\Requests\PostRecommendation;

use App\Http\Requests\Request;
use App\Rules\ListOfIds;

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
            'name' => 'required|max:255',
            'description' => 'max:16777215',
            'contact' => 'min:3|max:255',
            'website' => 'min:3|max:255',

            'post' => '',
            'post.propertyId' => 'required_with:post|exists:properties,id',
            'post.attachmentIds' => [new ListOfIds('attachments', 'id')]
        ];
    }
}
