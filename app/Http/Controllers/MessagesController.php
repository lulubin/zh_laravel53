<?php

namespace App\Http\Controllers;

use Auth;
use App\Repositories\MessageRepository;

class MessagesController extends Controller
{
    protected $messageRepository;

    public function __construct(MessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    public function store()
    {
        $message = $this->messageRepository->create([
            'to_user_id' => request('user'),
            'from_user_id' => user('api')->id,
            'content' => request('content')
        ]);
        if($message){
            $status = true;
        }else{
            $status = false;
        }
        return response()->json(['status'=>$status]);
    }
}
