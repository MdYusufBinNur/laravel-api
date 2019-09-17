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
            'propertyId' => 'required|list:numeric',
            'packageId' => 'list:numeric',
            'signOutUserId' => 'list:numeric',
            'startDate' => 'date',
            'endDate' => 'date',
            'unitId' => '',
        ];
    }
}
