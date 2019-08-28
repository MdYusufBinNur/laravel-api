<?php

namespace App\Http\Requests\NotificationTemplateProperty;

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
            'templateId' => 'required|exists:notification_templates,id',
        ];
    }
}
