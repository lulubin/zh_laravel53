<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SomebodyFocusYou extends Mailable
{
    use Queueable, SerializesModels;

    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->view('email.follow', $this->data);
    }
}
