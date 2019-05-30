<?php

namespace App\Http\Requests\UserProfileLink;

use App\DbModels\UserProfileLink;
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
            'userId' => 'exists:users,id',
            'type' => 'in:'.UserProfileLink::TYPE_COMPANY.','.UserProfileLink::TYPE_FACEBOOK.','.UserProfileLink::TYPE_LINKEDIN.','.UserProfileLink::TYPE_MYSPACE.''.UserProfileLink::TYPE_OTHER.','.UserProfileLink::TYPE_WEBSITE,
            'title' => 'min:5|max:191',
            'url' => 'min:5|max:191',
        ];
    }
}
