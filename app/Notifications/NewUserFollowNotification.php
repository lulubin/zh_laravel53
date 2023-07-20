<?php

namespace App\Notifications;

use App\Channels\qqMailChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Auth;
use Mail;

class NewUserFollowNotification extends Notification
{
    use Queueable;

    public function __construct()
    {
    }

    public function via($notifiable)
    {
        return ['database', qqMailChannel::class];
    }

    public function toQqMail($notifiable)
    {
        $data = [
            'url' => route('home'),
            'name' => user('api')->name,
        ];
        Mail::to($notifiable->email)->send(new \App\Mail\SomebodyFocusYou($data));
    }

    public function toQqMailOld($notifiable)
    {
        $data = [
            'url' => route('home'),
            'name' => user('api')->name,
        ];
        Mail::send('email.follow', $data, function ($message) use($notifiable){
            $subject = config('app.name').'上有人关注了你';
            $message->to($notifiable->email)->subject($subject);
        });
    }

    public function toDatabase($notifiable)
    {
        return [
            'name' => user('api')->name,
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
