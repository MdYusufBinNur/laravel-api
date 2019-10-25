<?php

namespace App\Http\Requests\NotificationTemplate;

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
            'typeId' => 'exists:notification_template_types,id',
            'title' => 'max:512',
            'text' => 'max:1024',
            'editable' => 'boolean',
        ];
    }
}
