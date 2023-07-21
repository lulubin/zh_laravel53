<?php

namespace App\Repositories;

use App\Message;

class MessageRepository
{
    public function create(array $attributes)
    {
        return Message::create($attributes);
    }

    public function getMessageList()
    {
        return Message::where('to_user_id',user()->id)
            ->orWhere('from_user_id',user()->id)
            ->with(['fromUser'=>function($query){
                return $query->select(['id','name','avatar']);
            },'toUser'=>function($query){
                return $query->select(['id','name','avatar']);
            }])
            ->latest()
            ->get()
            ->groupBy('dialog_id');
    }

    public function getMessageListByDialogId($dialogId)
    {
        $messages = Message::where('dialog_id', $dialogId)
            ->with(['fromUser'=>function($query){
                return $query->select(['id','name','avatar']);
            },'toUser'=>function($query){
                return $query->select(['id','name','avatar']);
            }])
            ->latest()
            ->get();
        $messages->markAsRead();
        return $messages;
    }

    public function store($dialogId)
    {
        $message = Message::where('dialog_id', $dialogId)->first();
        $toUserId = $message->from_user_id === user()->id ? $message->to_user_id : $message->from_user_id;
        return Message::create([
            'from_user_id' => user()->id,
            'to_user_id' => $toUserId,
            'content' => request('content'),
            'dialog_id' => $dialogId
        ]);
    }
}