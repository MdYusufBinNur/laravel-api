<?php

namespace App\Http\Requests\VisitorArchive;

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
            'visitorId' => 'exists:visitors:id',
            'signoutUserId' => 'exists:users:id',
            'signature' => 'boolean',
            'signout_at' => 'date',
        ];
    }
}
