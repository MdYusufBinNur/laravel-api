<?php

namespace App\Http\Requests\ResidentArchive;

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
            'email' => 'list:email',
            'propertyId' => 'list:numeric',
            'residentId' => 'list:numeric',
            'unitId' => 'list:numeric',
            'startAt' => 'list:date',
            'endAt' => 'list:date',
        ];
    }
}
