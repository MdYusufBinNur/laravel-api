<?php

namespace App\Http\Requests\ResidentDocument;

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
            'residentId' => 'exists:residents,id',
            'attachmentId' => '',
            'type' => '',
            'title' => '',
        ];
    }
}
