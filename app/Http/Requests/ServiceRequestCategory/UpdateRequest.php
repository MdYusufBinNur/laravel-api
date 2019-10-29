<?php

namespace App\Http\Requests\ServiceRequestCategory;

use App\DbModels\ServiceRequestCategory;
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
            'parentId' => 'exists:service_request_categories,id',
<<<<<<< HEAD
            'title' => 'min:3|max:255',
=======
            'title' => 'max:191',
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d
            'type' => 'in:'. ServiceRequestCategory::TYPE_UNIT. ','. ServiceRequestCategory::TYPE_COMMON,
            'active' => 'boolean',
        ];
    }
}
