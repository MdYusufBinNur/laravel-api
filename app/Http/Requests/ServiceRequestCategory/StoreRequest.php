<?php

namespace App\Http\Requests\ServiceRequestCategory;

use App\DbModels\ServiceRequestCategory;
use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

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
            'parentId' => 'exists:service_request_categories,id',
            'title' => 'required|min:3|max:191',
            'type' => 'in:'. ServiceRequestCategory::TYPE_UNIT. ','. ServiceRequestCategory::TYPE_COMMON,
            'active' => 'boolean',
        ];
    }
}