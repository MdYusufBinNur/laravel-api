<?php

namespace App\Http\Requests\NotificationFeed;

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
            'userId' => 'exists:users,id',
            'name' => 'string|min:3|max:100',
            'content' => 'string|min:5|max:512',
            'isRead' => 'boolean',
            'isViewed' => 'boolean',
        ];
    }
}
