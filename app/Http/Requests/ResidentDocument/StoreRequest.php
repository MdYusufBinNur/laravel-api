<?php

namespace App\Http\Requests\ResidentDocument;

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
            'residentId' => 'required|exists:residents,id',
            'attachmentId' => '',
            'type' => '',
            'title' => '',
        ];
    }
}
