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
<<<<<<< HEAD
            'title' => 'required|min:5|max:255',
            'text' => 'required|min:10|max:16777215',
=======
            'title' => 'required|max:512',
            'text' => 'required|max:1024',
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d
            'editable' => 'boolean',
        ];
    }
}
