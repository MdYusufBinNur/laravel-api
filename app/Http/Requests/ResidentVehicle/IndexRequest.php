<?php

namespace App\Http\Requests\ResidentVehicle;

use App\Http\Requests\Request;

class IndexRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'list:numeric',
            'residentId' => 'required|numeric',
            'make' => 'list:string',
            'model' => 'list:string',
            'color' => 'list:string',
            'licensePlate' => 'list:string',
        ];
    }
}
