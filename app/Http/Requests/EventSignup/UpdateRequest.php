<?php

namespace App\Http\Requests\EventSignup;

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
            'eventId' => 'exists:events,id',
            'userId' => 'exists:users,id',
            'residentId' => 'numeric',
            'guests' => 'numeric',
        ];
    }
}
