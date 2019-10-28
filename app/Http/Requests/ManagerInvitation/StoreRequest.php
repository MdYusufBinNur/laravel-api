<?php

namespace App\Http\Requests\ManagerInvitation;

use App\DbModels\ManagerInvitation;
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
            'propertyId'        => 'required|exists:properties,id',
<<<<<<< HEAD
            'email'             => 'required|unique:manager_invitations,email|max:255',
            'name'              => 'required|min:3|max:255',
            'title'             => 'min:3|max:255',
=======
            'email'             => 'required|unique:manager_invitations,email',
            'name'              => 'required|max:100',
            'title'             => 'max:512',
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d
            'level'             => 'in:'.ManagerInvitation::LEVEL_ADMIN.','.ManagerInvitation::LEVEL_STANDARD.','.ManagerInvitation::LEVEL_LIMITED.','.ManagerInvitation::LEVEL_RESTRICTED,
            'status'            => 'in:'.ManagerInvitation::STATUS_ACTIVE.','.ManagerInvitation::STATUS_CANCELLED.','.ManagerInvitation::STATUS_COMPLETED,
            'invitedAt'          => 'required|date',
        ];
    }
}
