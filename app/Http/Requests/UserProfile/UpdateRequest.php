<?php

namespace App\Http\Requests\UserProfile;

use App\DbModels\UserProfile;
use App\Http\Requests\Request;
use App\Rules\CSVString;
use Illuminate\Validation\Rule;

class UpdateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $userId = $this->segment(4);
        return [
            'userId' => 'exists:users,id',
            'gender' => 'in:'.UserProfile::GENDER_FEMALE.','.UserProfile::GENDER_MALE,
            'occupation' => 'min:3|max:255',
            'homeTown' => 'min:3|max:255',
            'birthDate' => 'date_format:Y-m-d',
            'language' => 'min:3|max:255',
            'website' => 'min:3|max:255',
            'facebookUsername' => 'min:3|max:100',
            'twitterUsername' => 'min:3|max:100',
            'aboutMe' => 'min:3|max:16777215',
            'interests' => [new CSVString()],

            'user'                 => '',
            'user.name'            => 'min:3|max:255',
            'user.phone' => Rule::unique('users')->ignore($userId, 'id'),
        ];
    }
}
