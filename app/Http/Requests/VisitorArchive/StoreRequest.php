<?php

namespace App\Http\Requests\VisitorArchive;

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
            'propertyId' => 'required|exists:properties,id',
            'visitorId' => 'required|exists:visitors,id|unique:visitor_archives,visitorId',
            'signature' => 'boolean',
        ];
    }
}
