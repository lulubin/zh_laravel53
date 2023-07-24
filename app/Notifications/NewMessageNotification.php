<?php

namespace App\Notifications;

use App\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewMessageNotification extends Notification
{
    use Queueable;

    public $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function via($notifiable)
    {
        return ['database'];
    }
    public function toDatabase($notifiable)
    {
        return [
            'name' => $this->message->fromUser->name,
            'dialog' => $this->message->dialog_id,
        ];
    }

    public function toArray($notifiable)
    {
        return [
        ];
    }
}
