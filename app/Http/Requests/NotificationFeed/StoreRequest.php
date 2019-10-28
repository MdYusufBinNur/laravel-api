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
<<<<<<< HEAD
            'name' => 'required|string|min:3|max:255',
            'content' => 'required|string|min:5|max:16777215',
=======
            'name' => 'required|string|max:100',
            'content' => 'required|string|max:512',
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d
            'isRead' => 'boolean',
            'isViewed' => 'boolean',
        ];
    }
}
