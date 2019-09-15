<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'propertyId' => 'exists:properties,id',
            'createdUserId' => 'numeric',
            'title' => 'min:5|max:191',
            'text' => 'min:5|max:512',
            'maxGuests' => 'numeric',
            'allowedSignUp' => 'boolean',
            'alldayEvent' => 'boolean',
            'allowedLoginPage' => 'boolean',
            'hasAttachment' => 'boolean',
            'startAt' => 'date_format:"H:i"|required|before:timeEnd',
            'endAt' => 'date_format:"H:i"|required|before:timeEnd',
            'date' => 'date',
        ];
    }
}
