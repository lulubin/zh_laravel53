<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnswerRequest;
use App\Repositories\AnswerRepository;
use Auth;

class AnswersController extends Controller
{
    protected $answerRepository;

    public function __construct(AnswerRepository $answerRepository)
    {
        $this->answerRepository = $answerRepository;
    }

    public function store(StoreAnswerRequest $request, $question)
    {
        $answer = $this->answerRepository->create([
            'question_id' => $question,
            'user_id' => Auth::id(),
            'content' => $request->get('content')
        ]);
        $answer->question()->increment('answers_count');
        return back();
    }
}
