<?php

namespace App\Http\Requests\CommitteeHierarchy;

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
            'committeeTypeId' => 'exists:committee_types,id',
            'position' => 'numeric',
            'title' => 'max:255',
        ];
    }
}
