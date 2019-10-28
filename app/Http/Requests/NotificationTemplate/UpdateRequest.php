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
<<<<<<< HEAD
            'title' => 'min:5|max:255',
            'text' => 'min:10|max:16777215',
=======
            'title' => 'max:512',
            'text' => 'max:1024',
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d
            'editable' => 'boolean',
        ];
    }
}
