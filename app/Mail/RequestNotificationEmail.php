<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RequestNotificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        $address = 'oluwasayo3@gmail.com';
        $subject = 'New Request';

        return $this->view('emails.notification')
                    ->from($address)
                    ->subject($subject)
                    ->with([ 'notification_message' => $this->data['message'] ]);
    }
}
