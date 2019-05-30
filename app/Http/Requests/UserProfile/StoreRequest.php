<?php

namespace App\Http\Requests\UserProfile;

use App\DbModels\UserProfile;
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
            'gender' => 'in:'.UserProfile::GENDER_FEMALE.','.UserProfile::GENDER_MALE,
            'occupation' => 'min:3|max:191',
            'homeTown' => 'min:3|max:191',
            'birthDate' => 'date',
            'language' => 'min:3|max:191',
            'website' => 'min:3|max:191',
            'facebookUsername' => 'min:3|max:100',
            'twitterUsername' => 'min:3|max:100',
            'aboutMe' => 'min:3|max:1024',
        ];
    }
}
