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
<<<<<<< HEAD
            'occupation' => 'min:3|max:255',
            'homeTown' => 'min:3|max:255',
            'birthDate' => 'date_format:Y-m-d|before:now',
            'language' => 'min:3|max:255',
            'website' => 'min:3|max:255',
            'facebookUsername' => 'min:3|max:100',
            'twitterUsername' => 'min:3|max:100',
            'aboutMe' => 'min:3|max:16777215',
=======
            'occupation' => 'max:191',
            'homeTown' => 'max:191',
            'birthDate' => 'date_format:Y-m-d|before:now',
            'language' => 'max:191',
            'website' => 'max:191',
            'facebookUsername' => 'max:100',
            'twitterUsername' => 'max:100',
            'aboutMe' => 'max:1024',
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d
            'interests' => [new CSVString()]
        ];
    }
}
