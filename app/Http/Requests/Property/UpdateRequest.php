<?php

namespace App\Http\Requests\Property;

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
        return $rules = [
            'company_id' => 'numeric|exists:companies,id',
            'title'      => 'min:3',
            'type'       => 'max:50',
            'subdomain'  => 'unique:properties,subdomain',
            'address'    => 'min:3',
            'city'       => '',
            'state'      => '',
            'post_code'  => 'max:10',
            'country'    => 'max:10',
            'language'   => 'max:10',
            'timezone'   => 'max:50',
            'active'     => 'numeric',
        ];
    }

}
