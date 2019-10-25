<?php

namespace App\Http\Requests\PropertyLink;

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
            'title' => 'required',
            'description' => '',
            'url' => 'required|max:1000',
            'linkCategoryId' => 'required|exists:property_link_categories,id',
            'isFeatured' => 'boolean',
        ];
    }
}
