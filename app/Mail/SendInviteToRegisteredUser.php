<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendInviteToRegisteredUser extends Mailable
{
    use Queueable, SerializesModels;

    private $fullname;
    private $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $token)
    {
        $this->fullname = $user->profile->fullname;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.sendInviteToRegisteredUser')
                    ->subject("You've been invited")
                    ->with([
                        'fullname'=>$this->fullname,
                        'token'=>$this->token
                    ]);
    }
}
