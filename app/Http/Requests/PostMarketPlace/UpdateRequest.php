<?php

namespace App\Http\Requests\PostMarketPlace;

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
            'postId' =>  'exists:posts,id',
            'type' =>  'in:'.PostMarketplace::TYPE_BUY. ','. PostMarketplace::TYPE_SELL,
            'title' =>  'min:3|max:191',
            'price' =>  'min:3|max:191',
            'description' => 'min:3|max:1024',
            'contact' => 'min:3|max:191',
        ];
    }
}
