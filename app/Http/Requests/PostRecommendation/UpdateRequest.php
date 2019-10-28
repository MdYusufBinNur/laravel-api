<?php

namespace App\Http\Requests\PostRecommendation;

use App\DbModels\Post;
use App\Http\Requests\Request;
use App\Rules\ListOfIds;

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
            'typeId' => 'exists:post_recommendation_types,id',
<<<<<<< HEAD
            'name' => 'min:3|max:255',
            'description' => 'string|max:16777215',
            'contact' => 'min:3|max:255',
            'website' => 'min:3|max:255',
=======
            'name' => 'max:191',
            'description' => 'string',
            'contact' => 'max:191',
            'website' => 'max:191',
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d

            'post' => '',
            'post.status' => 'in:' . Post::STATUS_PENDING . ',' . Post::STATUS_DENIED . ',' . Post::STATUS_APPROVED . ',' . Post::STATUS_POSTED,
            'post.likeChanged' => 'boolean',
            'post.attachmentIds' => [new ListOfIds('attachments', 'id')]
        ];
    }
}
