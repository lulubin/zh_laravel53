<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use Hash;

class PasswordController extends Controller
{
    public function password()
    {
        return view('users.password');
    }

    public function update(ChangePasswordRequest $request)
    {
        if(Hash::check($request->get('old_password'), user()->password)){
            user()->password = bcrypt($request->get('password'));
            user()->save();
            flash('密码修改成功', 'success');
            return bacK();
        }
        flash('密码修改失败', 'danger');
        return bacK();
    }
}
