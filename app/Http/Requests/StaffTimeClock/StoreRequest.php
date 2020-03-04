<?php

namespace App\Http\Requests\StaffTimeClock;

use App\DbModels\StaffTimeClock;
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
            'propertyId' => 'required|exists:properties,id',
            'managerId' => 'required|exists:managers,id',
            'clockInNote' => 'max:65535',
            'state' => 'required|in:' . StaffTimeClock::STATE_CHECK_IN . ',' . StaffTimeClock::STATE_BREAK_IN . ',' . StaffTimeClock::STATE_OVERTIME_IN,
            'attachmentId' => 'required|exists:attachments,id'
        ];
    }
}
