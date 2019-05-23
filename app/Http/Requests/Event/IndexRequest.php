<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'propertyId' => 'list:numeric',
            'createdUserId' => 'list:numeric',
            'title' => 'list:string',
            'text' => 'list:string',
            'maxGuests' => 'list:numeric',
            'allowedSignUp' => 'list:boolean',
            'alldayEvent' => 'list:boolean',
            'allowedLoginPage' => 'list:boolean',
            'hasAttachment' => 'list:boolean',
            'startAt' => 'list:dateTime',
            'endAt' => 'list:dateTime',
        ];
    }
}
