<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'old_password' => 'required|min:6',
            'password' => 'required|min:6|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'old_password.required' => '原始密码不能为空',
            'old_password.min' => '原始密码不能少于6个字符',
            'password.required' => '新密码不能为空',
            'password.min' => '新密码不能少于6个字符',
            'password.confirmed' => '两次输入的密码不一致',
        ];
    }
}
