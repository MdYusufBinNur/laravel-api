<?php

namespace App\Http\Requests\StaffTimeClock;

use App\DbModels\StaffTimeClock;
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
            'state' => 'required|in:' . StaffTimeClock::STATE_CHECK_OUT . ',' . StaffTimeClock::STATE_BREAK_OUT . ',' . StaffTimeClock::STATE_OVERTIME_OUT,
            'clockOutNote' => 'max:65535',
            'attachmentId' => 'required|exists:attachments,id'
        ];
    }
}
