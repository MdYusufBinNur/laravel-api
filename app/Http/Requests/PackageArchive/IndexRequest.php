<?php

namespace App\Http\Requests\PackageArchive;

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
            'packageId' => 'list:numeric',
            'signoutUserId' => 'list:numeric',
            'signoutComments' => 'list:string',
            'signature' => 'list:boolean',
            'signoutAt' => 'list:date',
        ];
    }
}
