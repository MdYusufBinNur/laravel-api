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
<<<<<<< HEAD
            'title' => 'min:3|max:255|unique_with:visitor_types,propertyId,' . $this->segment(4)
=======
            'title' => 'max:100|unique_with:visitor_types,propertyId,' . $this->segment(4)
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d
        ];
    }
}
