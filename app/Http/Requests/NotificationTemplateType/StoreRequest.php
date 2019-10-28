<?php

namespace App\Http\Requests\NotificationTemplateType;

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
            'key' => 'required|min:5|max:255',
            'module' => 'required|min:5|max:255',
        ];
    }
}
