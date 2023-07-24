<?php

namespace App\Http\Controllers;

class SettingController extends Controller
{
    public function index()
    {
        return view('users.setting');
    }

    public function store()
    {
        user()->setting()->merge(request()->all());
        return back();
    }
}
