<?php

namespace App\Http\Requests\UserProfileChild;

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
            'userId' => 'required|numeric',
            'gender' => 'list:string',
            'name' => 'list:string',
            'age' => 'list:string',
        ];
    }
}
