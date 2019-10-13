<?php

namespace App\Http\Requests\UserProfile;

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
            'gender' => 'list:string',
            'occupation' => 'list:string',
            'homeTown' => 'list:string',
            'birthDate' => 'list:date',
            'language' => 'list:string',
            'website' => 'list:string',
            'facebookUsername' => 'list:string',
            'twitterUsername' => 'list:string',
            'aboutMe' => 'list:text',
        ];
    }
}
