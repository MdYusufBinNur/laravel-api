<?php

namespace App\Http\Requests\UserProfileLink;

use App\DbModels\UserProfileLink;
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
            'userId' => 'required|exists:users,id',
            'type' => 'in:'.UserProfileLink::TYPE_COMPANY.','.UserProfileLink::TYPE_FACEBOOK.','.UserProfileLink::TYPE_LINKEDIN.','.UserProfileLink::TYPE_MYSPACE.''.UserProfileLink::TYPE_OTHER.','.UserProfileLink::TYPE_WEBSITE,
<<<<<<< HEAD
            'title' => 'required|min:5|max:255',
            'url' => 'required|min:5|max:255',
=======
            'title' => 'required|max:191',
            'url' => 'required|max:191',
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d
        ];
    }
}
