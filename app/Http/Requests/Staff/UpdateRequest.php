<?php

namespace App\Http\Requests\Staff;

use App\DbModels\Role;
use App\DbModels\User;
use App\Http\Requests\Request;
use Illuminate\Support\Facades\DB;

class UpdateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $staffId = $this->segment(4);
        $userId = DB::table('managers')->where('id', '=', $staffId)->pluck('userId')->toArray()[0];

        return $rules = [
            'contactEmail' => 'email|max:255',
            'propertyId' => 'exists:properties,id|required_with:role.addNewRole',
            'phone' => 'max:20',
            'timeClockDeviceUserId' => 'max:255',
            'title' => 'max:255',
            'level' => 'in:' . Role::ROLE_STAFF_PRIORITY['title'] . ',' . Role::ROLE_STAFF_STANDARD['title'] . ',' . Role::ROLE_STAFF_LIMITED['title'],
            'displayInCorner' => 'boolean',
            'displayPublicProfile' => '',

            'user' => '',
            'user.email' => 'max:255|email|unique:users,email,' . $userId . ',id',
            'user.name' => 'max:255',
            'user.password' => 'min:5|max:255',
            'user.locale' => 'in:en,bn',
            'user.isActive' => 'boolean',
        ];
    }

}
