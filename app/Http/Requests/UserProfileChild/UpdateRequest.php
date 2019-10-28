<?php

namespace App\Http\Requests\UserProfileChild;

use App\DbModels\UserProfileChild;
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
            'userId' => 'required|exists:users,id',
            'gender' => 'in:'.UserProfileChild::GENDER_MALE.','.UserProfileChild::GENDER_FEMALE,
            'name' => 'required|min:3|max:255',
            'age' => 'integer',
        ];
    }
}
