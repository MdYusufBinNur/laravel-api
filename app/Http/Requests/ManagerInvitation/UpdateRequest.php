<?php

namespace App\Http\Requests\ManagerInvitation;

use App\DbModels\ManagerInvitation;
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
            'propertyId'        => 'exists:properties,id',
            'email'             => 'unique:manager_invitations,email',
            'name'              => 'min:3|max:100',
            'title'             => 'min:3|max:512',
            'level'             => 'in:'.ManagerInvitation::LEVEL_ADMIN.','.ManagerInvitation::LEVEL_STANDARD.','.ManagerInvitation::LEVEL_LIMITED.','.ManagerInvitation::LEVEL_RESTRICTED,
            'status'            => 'in:'.ManagerInvitation::STATUS_ACTIVE.','.ManagerInvitation::STATUS_CANCELLED.','.ManagerInvitation::STATUS_COMPLETED,
            'invitedAt'          => 'date',
        ];
    }
}