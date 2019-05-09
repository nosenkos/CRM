<?php

namespace App\Events;

use App\Mail\SendInviteToRegisteredUser;
use App\Mail\SendInviteToUnregisteredUser;
use App\Models\Invite;
use App\Models\Team;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class InviteUser
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $email;
    private $token;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($email)
    {
        $this->email = $email;
        $this->token = Hash::make($this->email . time());

        if($user = $this->isUserRegistered()){
            $this->sendInviteToRegisteredUser($user);
            $user_id = $user->id;
        }else{
            $this->sendInviteToUnregisteredUser();
            $user_id = NULL;
        }

        Invite::updateOrCreate([
            'user_id'=>$user_id,
            'team_id'=>auth()->user()->own_team->id,
            'email'=>$this->email
        ],[
            'user_id'=>$user_id,
            'team_id'=>auth()->user()->own_team->id,
            'token'=>$this->token,
            'email'=>$this->email
        ]);

        Session::flash('success',__('Invite has been sent'));
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }

    protected function isUserRegistered(){
        if($user = User::where('email','=',$this->email)->first()){
            return $user;
        }
        return false;
    }

    private function sendInviteToRegisteredUser(User $user){
        Mail::to($user->email)->send(new SendInviteToRegisteredUser($user, $this->token));
    }

    private function sendInviteToUnregisteredUser(){
        Mail::to($this->email)->send(new SendInviteToUnregisteredUser($this->email, $this->token));
    }
}














