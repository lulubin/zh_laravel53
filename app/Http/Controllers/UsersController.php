<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    public function avatar()
    {
        return view('users.avatar');
    }

    public function changeAvatar()
    {
        $file = request()->file('img');
        $filename = 'avatars/'.md5(time().user()->id).'.'.$file->getClientOriginalExtension();
        $file->move(public_path('avatars'), $filename);

//        user()->avatar = '/'.$filename;
        Storage::disk('qiniu')->writeStream($filename, fopen($file->getRealPath(),'r'));
        user()->avatar = env('QINIU_DOMAIN').'/'.$filename;
        user()->save();

        return [
            'url' => user()->avatar
        ];
    }
}
