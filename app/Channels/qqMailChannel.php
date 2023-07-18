<?php
namespace App\Channels;

use Illuminate\Notifications\Notification;

class qqMailChannel
{
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toQqMail($notifiable);
    }
}