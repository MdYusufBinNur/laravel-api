<?php

namespace App\Http\Requests\VisitorArchive;

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
            'visitorId' => 'required|exists:visitors:id',
            'signOutUserId' => 'required|exists:users:id',
            'signature' => 'boolean',
            'signOutAt' => 'required|date',
        ];
    }
}
