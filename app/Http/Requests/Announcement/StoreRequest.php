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
            'title' => 'required|min:5|max:255',
            'content' => 'required|min:5|max:16777215',
            'link' => 'required|min:5|max:255',
            'linkinNewWindows' => 'boolean',
            'showOnWebsite' => 'boolean',
            'showOnLds' => 'boolean',
            'expireAt' => 'required|date_format:Y-m-d',
        ];
    }
}
