<?php

namespace App\Http\Requests\NotificationTemplate;

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
            'typeId' => 'required|exists:notification_template_types,id',
            'title' => 'required|min:5|max:512',
            'text' => 'required|min:10|max:1024',
            'editable' => 'boolean',
        ];
    }
}