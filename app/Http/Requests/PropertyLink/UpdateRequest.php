<?php

namespace App\Http\Requests\PropertyLink;

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
            'propertyId' => 'exists:properties,id',
            'title' => 'min:2',
            'description' => 'min:5',
            'url' => 'min:10',
            'linkCategoryId' => 'exists:property_link_categories,id',
            'isFeatured' => 'boolean',
        ];
    }
}
