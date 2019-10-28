<?php

namespace App\Http\Requests\Announcement;

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
<<<<<<< HEAD
            'title' => 'min:5|max:255',
            'content' => 'min:5|max:16777215',
            'link' => 'min:5|max:255',
=======
            'title' => 'max:191',
            'content' => 'max:256',
            'link' => 'max:190',
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d
            'linkinNewWindows' => 'boolean',
            'showOnWebsite' => 'boolean',
            'showOnLds' => 'boolean',
            'expireAt' => 'date',
        ];
    }
}
