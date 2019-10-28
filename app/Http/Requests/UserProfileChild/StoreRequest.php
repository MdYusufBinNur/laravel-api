<?php

namespace App\Http\Requests\UserProfileChild;

use App\DbModels\UserProfileChild;
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
            'gender' => 'in:'.UserProfileChild::GENDER_MALE.','.UserProfileChild::GENDER_FEMALE,
<<<<<<< HEAD
            'name' => 'required|min:3|max:255',
=======
            'name' => 'required|max:191',
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d
            'age' => 'integer',
        ];
    }
}
