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
            'title' => 'min:5|max:255',
            'content' => 'min:5|max:16777215',
            'link' => 'min:5|max:255',
            'linkinNewWindows' => 'boolean',
            'showOnWebsite' => 'boolean',
            'showOnLds' => 'boolean',
            'expireAt' => 'date',
        ];
    }
}
