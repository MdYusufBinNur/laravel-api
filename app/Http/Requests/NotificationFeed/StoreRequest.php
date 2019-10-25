<?php

namespace App\Http\Requests\NotificationFeed;

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
            'userId' => 'required|exists:users,id',
            'name' => 'required|string|max:100',
            'content' => 'required|string|max:512',
            'isRead' => 'boolean',
            'isViewed' => 'boolean',
        ];
    }
}
