<?php

namespace App\Http\Controllers;

use App\Repositories\MessageRepository;

class InboxController extends Controller
{
    protected $messageRepository;

    public function __construct(MessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
        $this->middleware('auth');
    }

    public function index()
    {
        $messages = $this->messageRepository->getMessageList();
        return view('inbox.index', compact('messages'));
    }

    public function show($dialogId)
    {
        $messages = $this->messageRepository->getMessageListByUserId($dialogId);
        return view('inbox.show', compact('messages','dialogId'));
    }

    public function store($dialogId)
    {
        $this->messageRepository->store($dialogId);
        return back();
    }
}