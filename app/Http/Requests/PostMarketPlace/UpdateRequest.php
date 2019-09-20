<?php

namespace App\Http\Requests\PostMarketPlace;

use App\DbModels\Post;
use App\DbModels\PostMarketplace;
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
            'type' =>  'in:'.PostMarketplace::TYPE_BUY. ','. PostMarketplace::TYPE_SELL,
            'title' =>  'min:3|max:191',
            'price' =>  'min:3|max:191',
            'description' => 'string',
            'contact' => 'min:3|max:191',

            'post' => '',
            'post.status' => 'in:' . Post::STATUS_PENDING . ',' . Post::STATUS_DENIED . ',' . Post::STATUS_APPROVED . ',' . Post::STATUS_POSTED,
            'post.likeChanged' => 'boolean',
            'post.attachmentIds' => 'json|json_ids:attachments,id',
        ];
    }
}
