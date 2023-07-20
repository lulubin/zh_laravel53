<?php

namespace App\Http\Controllers;

use App\Repositories\AnswerRepository;
use App\Repositories\CommentRepository;
use App\Repositories\QuestionRepository;
use Auth;

class CommentsController extends Controller
{
    private $answerRepository;
    private $commentRepository;
    private $questionRepository;

    public function __construct(AnswerRepository $answerRepository, CommentRepository $commentRepository, QuestionRepository $questionRepository)
    {
        $this->answerRepository = $answerRepository;
        $this->commentRepository = $commentRepository;
        $this->questionRepository = $questionRepository;
    }

    public function index()
    {
        if(request('type') == 'question'){
            return $this->questionRepository->getQuestionCommentsById(request('model'));
        }
        return $this->answerRepository->getAnswerCommentsById(request('model'));
    }

    public function store()
    {
        $model = $this->getModelNameFormType(request('type'));
        return $this->commentRepository->create([
            'commentable_id' => request('model'),
            'commentable_type' => $model,
            'user_id' => Auth::guard('api')->user()->id,
            'content' => request('content'),
        ]);
    }

    private function getModelNameFormType($type)
    {
        return $type === 'question' ? 'App\Question' : 'App\Answer';
    }
}
