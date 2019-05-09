<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendInviteToUnregisteredUser extends Mailable
{
    use Queueable, SerializesModels;

    private $email;
    private $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $token)
    {
        $this->email = $email;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
                ->subject("You've been invited")
                ->view('mail.sendInviteToUnregisteredUser')
                ->with([
                    'email'=>$this->email,
                    'token'=>$this->token
                ]);
    }
}
