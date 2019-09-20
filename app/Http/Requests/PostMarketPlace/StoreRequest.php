<?php

namespace App\Http\Requests\PostMarketPlace;

use App\DbModels\PostMarketplace;
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
            'postId' =>  'required_without|exists:posts,id',
            'type' =>  'in:'.PostMarketplace::TYPE_BUY. ','. PostMarketplace::TYPE_SELL,
            'title' =>  'required|min:3|max:191',
            'price' =>  'required|min:3|max:191',
            'description' => 'required',
            'contact' => 'min:3|max:191',

            'post' => '',
            'post.propertyId' => 'required_with:post|exists:properties,id',
            'post.attachmentIds' => 'json|json_ids:attachments,id',
        ];
    }
}
