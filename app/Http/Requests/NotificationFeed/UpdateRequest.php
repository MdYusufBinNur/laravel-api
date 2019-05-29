<?php

namespace App\Http\Requests\NotificationFeed;

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
            'propertyId' => 'exists:properties,id',
            'userId' => 'exists:users,id',
            'name' => 'string|min:3|max:100',
            'content' => 'string|min:5|max:512',
            'isRead' => 'boolean',
            'isViewed' => 'boolean',
        ];
    }
}