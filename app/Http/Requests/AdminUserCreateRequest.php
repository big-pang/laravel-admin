<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AdminUserCreateRequest extends Request
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
            'name'=>'required|unique:admin_users|max:255',
            'email'=>'required|unique:admin_users|email|max:255',
            'password'=>'required|confirmed|min:6|max:50'
        ];
    }
}
