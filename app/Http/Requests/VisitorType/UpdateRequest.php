<?php

namespace App\Http\Requests\VisitorType;

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
            'title' => 'max:255|unique_with:visitor_types,propertyId,' . $this->segment(4)
        ];
    }
}
