<?php

namespace App\Http\Requests\FdiLog;

use App\DbModels\FdiLog;
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
            'fdiId' => 'required|exists:fdis,id',
            'userId' => 'required|exists:users,id',
<<<<<<< HEAD
            'text' => 'required|min:3|max:16777215',
=======
            'text' => 'required|max:1024',
>>>>>>> eae7f62ab2e16e3e4807cfd8a0b3bd72a3d4525d
            'type' => 'required|in:'.FdiLog::TYPE_ADD.','.FdiLog::TYPE_EDIT.','.FdiLog::TYPE_EXPIRED.','.FdiLog::TYPE_APPROVED.','.FdiLog::TYPE_DENIED,
        ];
    }
}
