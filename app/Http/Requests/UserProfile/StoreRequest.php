<?php

namespace App\Http\Requests\UserProfile;

use App\DbModels\UserProfile;
use App\Http\Requests\Request;
use App\Rules\CSVString;
use Illuminate\Validation\Rule;

class StoreRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $userId = $this->request->get('userId');

        return [
            'userId' => 'required|exists:users,id',
            'gender' => 'in:'.UserProfile::GENDER_FEMALE.','.UserProfile::GENDER_MALE,
            'occupation' => 'max:255',
            'homeTown' => 'max:255',
            'birthDate' => 'date_format:Y-m-d|before:now',
            'language' => 'max:255',
            'website' => 'max:255',
            'facebookUsername' => 'max:100',
            'twitterUsername' => 'max:100',
            'aboutMe' => 'max:16777215',
            'interests' => [new CSVString()],
            'user'                 => '',
            'user.name'            => 'min:3|max:255',
            'user.phone' => [Rule::unique('users', 'phone')->ignore($userId, 'id'), 'phone:BD'],
            'user.email' => ['email', Rule::unique('users', 'email')->ignore($userId, 'id')],

        ];
    }
}
