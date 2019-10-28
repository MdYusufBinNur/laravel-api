<?php

namespace App\Http\Requests\Announcement;

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
<<<<<<< HEAD
            'title' => 'required|min:5|max:255',
            'content' => 'required|min:5|max:16777215',
            'link' => 'required|min:5|max:255',
=======
            'title' => 'required|max:191',
            'content' => 'required|max:256',
            'link' => 'required|max:190',
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d
            'linkinNewWindows' => 'boolean',
            'showOnWebsite' => 'boolean',
            'showOnLds' => 'boolean',
            'expireAt' => 'required|date',
        ];
    }
}
