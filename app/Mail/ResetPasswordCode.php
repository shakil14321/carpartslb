<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetPasswordCode extends Mailable
{
    use Queueable, SerializesModels;

    public $token;
    public $name;

    public function __construct($token, $name = null)
    {
        $this->token = $token;
        $this->name = $name;
    }

    public function build()
    {
        return $this->subject('Password reset code')
                    ->view('emails.reset-code')
                    ->with(['token' => $this->token, 'name' => $this->name]);
    }
}
