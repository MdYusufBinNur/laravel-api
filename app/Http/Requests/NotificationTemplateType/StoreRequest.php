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
            'key' => 'required|max:256',
            'module' => 'required|max:512',
        ];
    }
}
