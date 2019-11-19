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
            'id' => 'numeric',
            'propertyId' => 'required|numeric',
            'title' => 'string',
            'allowedSignUp' => 'boolean',
            'multipleDaysEvent' => 'boolean',
            'allowedLoginPage' => 'boolean',
            'startDate' => 'date_format:Y-m-d',
            'endDate' => 'date_format:Y-m-d',
        ];
    }
}
