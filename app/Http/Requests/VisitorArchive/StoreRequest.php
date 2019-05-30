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
            'signoutUserId' => 'required|exists:users:id',
            'signature' => 'boolean',
            'signout_at' => 'required|date',
        ];
    }
}
