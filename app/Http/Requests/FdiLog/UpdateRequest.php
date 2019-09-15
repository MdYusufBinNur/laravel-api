<?php

namespace App\Http\Requests\FdiLog;

use App\DbModels\FdiLog;
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
            'fdiId' => 'exists:fdis,id',
            'userId' => 'exists:users,id',
            'text' => 'min:3|max:1024',
            'type' => 'in:'.FdiLog::TYPE_ADD.','.FdiLog::TYPE_EDIT.','.FdiLog::TYPE_EXPIRED.','.FdiLog::TYPE_APPROVED.','.FdiLog::TYPE_DENIED,
        ];
    }
}