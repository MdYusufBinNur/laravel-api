<?php

namespace App\Http\Requests\NotificationTemplateProperty;

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
            'templateId' => 'exists:notification_templates,id',
        ];
    }
}
