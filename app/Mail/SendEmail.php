<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $title,$text;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($title,$text)
    {
        $this->title = $title;
        $this->text = $text;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $userEmail = Auth::user()->email;
        $mail = $this->text('emails.mail-content')->from($userEmail)->subject($this->title)->with(['text' => $this->text]);
        if (!is_null($this->title)) {
            $mail->subject($this->title);
        };
        return $mail;
    }
}
