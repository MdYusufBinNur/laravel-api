<?php

namespace App\Http\Requests\PostRecommendation;

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
            'typeId' =>  'list:numeric',
            'name' =>  'list:string',
            'description' =>  'list:text',
            'contact' =>  'list:string',
            'website' =>  'list:string',
        ];
    }
}
