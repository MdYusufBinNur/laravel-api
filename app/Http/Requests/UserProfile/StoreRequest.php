<?php

namespace App\Http\Requests\UserProfile;

use App\DbModels\UserProfile;
use App\Http\Requests\Request;
use App\Rules\CSVString;

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
            'gender' => 'in:'.UserProfile::GENDER_FEMALE.','.UserProfile::GENDER_MALE,
            'occupation' => 'min:3|max:191',
            'homeTown' => 'min:3|max:191',
            'birthDate' => 'date_format:Y-m-d|before:now',
            'language' => 'min:3|max:191',
            'website' => 'min:3|max:191',
            'facebookUsername' => 'min:3|max:100',
            'twitterUsername' => 'min:3|max:100',
            'aboutMe' => 'min:3|max:1024',
            'interests' => [new CSVString()]
        ];
    }
}
