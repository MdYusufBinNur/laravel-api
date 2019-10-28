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
<<<<<<< HEAD
            'name' => 'string|min:3|max:255',
            'content' => 'string|min:5|max:16777215',
=======
            'name' => 'string|max:100',
            'content' => 'string|max:512',
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d
            'isRead' => 'boolean',
            'isViewed' => 'boolean',
        ];
    }
}
