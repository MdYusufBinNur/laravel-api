<?php

namespace App\Http\Requests\PostMarketPlace;

use App\DbModels\Post;
use App\DbModels\PostMarketplace;
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
            'type' =>  'in:'.PostMarketplace::TYPE_BUY. ','. PostMarketplace::TYPE_SELL,
            'title' =>  'min:3|max:255',
            'price' =>  'min:3|max:255',
            'description' => 'string|max:16777215',
            'contact' => 'max:255',

            'post' => '',
            'post.status' => 'in:' . Post::STATUS_PENDING . ',' . Post::STATUS_DENIED . ',' . Post::STATUS_APPROVED . ',' . Post::STATUS_POSTED,
            'post.likeChanged' => 'boolean',
            'post.attachmentIds' => [new ListOfIds('attachments', 'id')]
        ];
    }
}
