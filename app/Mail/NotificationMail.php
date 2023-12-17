<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationMail extends Mailable
{
use Queueable, SerializesModels;

public $emailData;

public function __construct(array $emailData)
{
$this->emailData = $emailData;
}

    public function build()
    {
        return $this->view('emails.notification')
            ->subject('Telegram Notification');
    }

}
