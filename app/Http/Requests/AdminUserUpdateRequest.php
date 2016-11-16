<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AdminUserUpdateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required|unique:admin_users,name,'.$this->get('id').'|max:255',
            'email'=>'required|email|unique:admin_users,email,'.$this->get('id').'|max:255',
            'password'=>'confirmed|min:6|max:50'
        ];
    }
}
