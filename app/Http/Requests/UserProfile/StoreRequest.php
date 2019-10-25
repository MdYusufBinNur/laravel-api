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
            'occupation' => 'max:191',
            'homeTown' => 'max:191',
            'birthDate' => 'date_format:Y-m-d|before:now',
            'language' => 'max:191',
            'website' => 'max:191',
            'facebookUsername' => 'max:100',
            'twitterUsername' => 'max:100',
            'aboutMe' => 'max:1024',
            'interests' => [new CSVString()]
        ];
    }
}
