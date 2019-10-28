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
<<<<<<< HEAD
            'title' => 'required|min:2|max:255',
            'description' => 'min:5|max:65535',
=======
            'title' => 'required',
            'description' => '',
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d
            'url' => 'required|max:1000',
            'linkCategoryId' => 'required|exists:property_link_categories,id',
            'isFeatured' => 'boolean',
        ];
    }
}
