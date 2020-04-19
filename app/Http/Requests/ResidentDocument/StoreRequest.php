<?php

namespace App\Http\Requests\ResidentDocument;

use App\Http\Requests\Request;
use App\Rules\ListOfIds;

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
            'residentId' => 'required|exists:residents,id',
            'attachmentIds' => [new ListOfIds('attachments', 'id')],
            'type' => 'string|max:255',
            'title' => 'string|max:255',
        ];
    }
}
