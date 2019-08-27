<?php

namespace App\Http\Requests\ManagerInvitation;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $rules = [
            'id'        => 'list:numeric',
            'key'       => 'list:string',
            'title'     => 'list:string',
        ];
    }
}
