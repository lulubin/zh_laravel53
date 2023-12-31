<?php

namespace App\Http\Controllers;

use App\Repositories\AnswerRepository;
use Auth;
use Illuminate\Http\Request;

class VotesController extends Controller
{
    protected $answer;

    public function __construct(AnswerRepository $answer)
    {
        $this->answer = $answer;
    }

    public function index(Request $request)
    {
        if(user('api')->hasVotedFor($request->get('answer'))){
            $voted = true;
        }else{
            $voted = false;
        }
        return response()->json(['voted'=>$voted]);
    }

    public function vote()
    {
        $answer = $this->answer->byId(request('answer'));
        $userToVote = user('api')->voteFor(request('answer'));
        if(count($userToVote['attached']) > 0){
            $answer->increment('votes_count');
            $voted = true;
        }else{
            $answer->decrement('votes_count');
            $voted = false;
        }
        return response()->json(['voted'=>$voted]);
    }
}
