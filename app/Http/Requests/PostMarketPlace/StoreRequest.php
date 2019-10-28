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
<<<<<<< HEAD
            'title' =>  'required|min:3|max:255',
            'price' =>  'required|min:3|max:255',
            'description' => 'required|max:16777215',
            'contact' => 'min:3|max:255',
=======
            'title' =>  'required|max:191',
            'price' =>  'required|max:191',
            'description' => 'required',
            'contact' => 'max:191',
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d

            'post' => '',
            'post.propertyId' => 'required_with:post|exists:properties,id',
            'post.attachmentIds' => [new ListOfIds('attachments', 'id')]
        ];
    }
}
