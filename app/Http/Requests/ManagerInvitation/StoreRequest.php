<?php

namespace App\Http\Requests\ManagerInvitation;

use App\DbModels\ManagerInvitation;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'email'             => 'required|unique:manager_invitations,email',
            'name'              => 'required|min:3|max:100',
            'title'             => 'min:3|max:512',
            'level'             => 'in:'.ManagerInvitation::LEVEL_ADMIN.','.ManagerInvitation::LEVEL_STANDARD.','.ManagerInvitation::LEVEL_LIMITED.','.ManagerInvitation::LEVEL_RESTRICTED,
            'status'            => 'in:'.ManagerInvitation::STATUS_ACTIVE.','.ManagerInvitation::STATUS_CANCELLED.','.ManagerInvitation::STATUS_COMPLETED,
            'pin'               => 'required|min:5|max:20',
            'invitedAt'          => 'required|date',
        ];
    }
}
