<?php

namespace App\Http\Requests\EventSignup;

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
            'eventId' => 'numeric',
            'userId' => 'list:numeric',
            'residentId' => 'list:numeric',
            'guests' => 'numeric',
            'startDate' => 'date_format:Y-m-d',
            'endDate' => 'date_format:Y-m-d',
        ];
    }
}
