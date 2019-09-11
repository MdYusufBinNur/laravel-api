<?php

namespace App\Http\Requests\ServiceRequestMessage;

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
            'text' => 'min:10|max:2048',
            'readStatus' => 'boolean',
        ];
    }
}
