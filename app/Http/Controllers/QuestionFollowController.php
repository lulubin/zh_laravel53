<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class QuestionFollowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function follow($question)
    {
        Auth::user()->followsThis($question);
        return back();
    }
}
