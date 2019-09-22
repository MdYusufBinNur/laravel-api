<?php

namespace App\Http\Requests\Event;

use App\Http\Requests\Request;

class IndexRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'propertyId' => 'required|numeric',
            'title' => 'string',
            'allowedSignUp' => 'boolean',
            'allDayEvent' => 'boolean',
            'allowedLoginPage' => 'boolean',
            'startDate' => 'date',
            'endDate' => 'date',
        ];
    }
}
