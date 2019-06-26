<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UpdateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $userId = $this->segment(4);
        return $rules = [
            'password' => 'min:5|required_with:current_password',
            'current_password' => 'required_with:password',
            'email' => Rule::unique('users')->ignore($userId, 'id'),
            'name' => '',
            'isActive' => 'boolean',
            'addNewRole' => 'boolean',
            'roles' => '',
            'roles.id' => 'exists:users_roles,id',
            'roles.roleId' => 'exists:roles,id',
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param \Illuminate\Validation\Validator $validator
     * @return void
     */
    public function withValidator($validator)
    {
        parent::withValidator($validator);

        $validator->after(function ($validator) {
            if ($this->input('password')) {

                // get User model from route binding
                $user = $this->route('user');

                if (empty($user->password)) {
                    $this->request->add(['password' => $this->input('password')]);
                    $this->request->remove('current_password');
                } else if (Hash::check($this->input('current_password'), $user->password)) {
                    $this->request->add(['password' => $this->input('password')]);
                    $this->request->remove('current_password');
                } else {
                    $validator->errors()->add('current_password', 'Current password doesn\'t match.');
                }
            }
        });
    }


    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'password.required_with' => 'New password is required when current password is present.',
        ];
    }

}
