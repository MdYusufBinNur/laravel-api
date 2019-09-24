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
            'contactEmail' => 'email',
            'propertyId' => 'exists:properties,id|required_with:role.addNewRole',
            'phone' => 'max:100',
            'title' => 'min:5',
            'level' => '',
            'displayInCorner' => 'boolean',
            'displayPublicProfile' => '',

            'user' => '',
            'user.email' => 'email|unique:users,email,' . $userId . ',id',
            'user.name' => 'max:100',
            'user.password' => 'min:5',
            'user.locale' => '',
            'user.isActive' => 'boolean',

            'role' => '',
            'role.roleId' => 'in:' . Role::ROLE_STAFF_PRIORITY['id'] . ',' . Role::ROLE_STAFF_STANDARD['id'] . ',' . Role::ROLE_STAFF_LIMITED['id'],
        ];
    }

}
