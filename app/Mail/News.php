<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class News extends Mailable
{
    use Queueable, SerializesModels;
    public $msg;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($m)
    {
        $this->msg = $m;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Mail from Tohonay')->view('newsLetter');
    }
}
