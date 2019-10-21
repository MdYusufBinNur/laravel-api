<?php

namespace App\Http\Requests\ResidentArchive;

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
            'residentIds' => ['required', new ListOfIds('attachments', 'id')],
        ];
    }
}
