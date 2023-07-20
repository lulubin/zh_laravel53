<?php

namespace App\Http\Controllers;

use App\Repositories\QuestionRepository;
use Auth;

class QuestionFollowController extends Controller
{
    protected $questionRepository;

    public function __construct(QuestionRepository $questionRepository)
    {
        $this->middleware('auth');
        $this->questionRepository = $questionRepository;
    }

    public function follow($question)
    {
        Auth::user()->followsThis($question);
        return back();
    }

    public function follower()
    {
        $followed = user('api')->followed(request('question'));
        return response()->json(['followed' => $followed]);
    }

    public function followThisQuestion()
    {
        $followed = user('api')->followsThis(request('question'));
        $question = $this->questionRepository->byId(request('question'));
        if(count($followed['detached']) > 0){
            $followed = false;
            $question->decrement('followers_count');
        }else{
            $followed = true;
            $question->increment('followers_count');
        }
        return response()->json(['followed' => $followed]);
    }
}
