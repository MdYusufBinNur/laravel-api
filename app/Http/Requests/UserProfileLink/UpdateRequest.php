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
<<<<<<< HEAD
            'title' => 'min:5|max:255',
            'url' => 'min:5|max:255',
=======
            'title' => 'max:191',
            'url' => 'max:191',
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d
        ];
    }
}
