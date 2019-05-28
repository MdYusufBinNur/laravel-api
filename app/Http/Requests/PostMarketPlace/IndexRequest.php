<?php

namespace App\Http\Requests\PostMarketPlace;

use App\Http\Requests\Request;

class IndexRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'list:numeric',
            'postId' =>  'list:numeric',
            'type' =>  'list:string',
            'title' =>  'list:string',
            'price' =>  'list:string',
            'description' => 'list:text',
            'contact' => 'list:string',
        ];
    }
}
