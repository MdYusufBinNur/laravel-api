<?php

namespace App\Http\Requests\NotificationTemplateType;

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
            'key' => 'min:5|max:256',
            'module' => 'min:5|max:512',
        ];
    }
}
