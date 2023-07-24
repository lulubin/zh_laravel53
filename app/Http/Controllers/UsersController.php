<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    public function avatar()
    {
        dd(env('QINIU_DOMAIN'));
        return view('users.avatar');
    }

    public function changeAvatar()
    {
        var_dump(env('QINIU_DOMAIN'));exit;
        $file = request()->file('img');
        $filename = 'avatars/'.md5(time().user()->id).'.'.$file->getClientOriginalExtension();
        //本地
//        $file->move(public_path('avatars'), $filename);
//        user()->avatar = '/'.$filename;
        //七牛
        Storage::disk('qiniu')->writeStream($filename, fopen($file->getRealPath(),'r'));
        user()->avatar = env('QINIU_DOMAIN').'/'.$filename;
        user()->save();

        return [
            'url' => user()->avatar
        ];
    }
}
