<?php

namespace App\Http\Controllers;

use Auth;
use App\Comment;

class CommentsController extends Controller
{
    public function index()
    {
        $model = $this->getModelNameFormType(request('type'));
        return $model::with('comments','comments.user')->where('id',request('model'))->first()->comments;
    }

    public function store()
    {
        $model = $this->getModelNameFormType(request('type'));
        return Comment::create([
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
