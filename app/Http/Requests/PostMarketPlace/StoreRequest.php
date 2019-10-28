<?php

namespace App\Http\Requests\PostMarketPlace;

use App\DbModels\PostMarketplace;
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
            'postId' =>  'required_without|exists:posts,id',
            'type' =>  'in:'.PostMarketplace::TYPE_BUY. ','. PostMarketplace::TYPE_SELL,
            'title' =>  'required|min:3|max:255',
            'price' =>  'required|min:3|max:255',
            'description' => 'required|max:16777215',
            'contact' => 'min:3|max:255',

            'post' => '',
            'post.propertyId' => 'required_with:post|exists:properties,id',
            'post.attachmentIds' => [new ListOfIds('attachments', 'id')]
        ];
    }
}
