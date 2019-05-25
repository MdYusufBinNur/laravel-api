<?php

namespace App\Http\Requests\EventSignup;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'eventId' => 'required|exists:events,id',
            'userId' => 'required|exists:users,id',
            'residentId' => 'required|numeric',
            'guests' => 'required|numeric',
        ];
    }
}
