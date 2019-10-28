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
<<<<<<< HEAD
            'title' =>  'min:3|max:255',
            'price' =>  'min:3|max:255',
            'description' => 'string|max:16777215',
            'contact' => 'min:3|max:255',
=======
            'title' =>  'max:191',
            'price' =>  'max:191',
            'description' => 'string',
            'contact' => 'max:191',
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d

            'post' => '',
            'post.status' => 'in:' . Post::STATUS_PENDING . ',' . Post::STATUS_DENIED . ',' . Post::STATUS_APPROVED . ',' . Post::STATUS_POSTED,
            'post.likeChanged' => 'boolean',
            'post.attachmentIds' => [new ListOfIds('attachments', 'id')]
        ];
    }
}
