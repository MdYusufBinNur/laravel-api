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
<<<<<<< HEAD
            'name' => 'required|max:255',
            'description' => 'max:16777215',
            'contact' => 'min:3|max:255',
            'website' => 'min:3|max:255',
=======
            'name' => 'required|max:191',
            'description' => 'string',
            'contact' => 'max:191',
            'website' => 'max:191',
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d

            'post' => '',
            'post.propertyId' => 'required_with:post|exists:properties,id',
            'post.attachmentIds' => [new ListOfIds('attachments', 'id')]
        ];
    }
}
