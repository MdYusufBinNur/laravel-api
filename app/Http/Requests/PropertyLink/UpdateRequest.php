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
            'title' => 'required|min:2|max:255',
            'description' => 'min:5|max:65535',
            'url' => 'required|max:1000',
            'linkCategoryId' => 'required|exists:property_link_categories,id',
            'isFeatured' => 'boolean',
            'iconName' => 'string'
        ];
    }
}
