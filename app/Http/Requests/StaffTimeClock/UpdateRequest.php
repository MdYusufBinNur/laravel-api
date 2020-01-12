<?php

namespace App\Http\Requests\StaffTimeClock;

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
            'clockOutNote' => 'max:65535',
            'attachmentId' => 'required|exists:attachments,id'
        ];
    }
}
