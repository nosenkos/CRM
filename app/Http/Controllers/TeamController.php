<?php

namespace App\Http\Controllers;

use App\Events\InviteUser;
use App\Mail\SendInviteToRegisteredUser;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TeamController extends Controller
{
    public function index(){
        return view('teams.index');
    }

    public function invite(){
        return view('teams.invite');
    }

    public function sendInvite(Request $request){
        $request->validate([
            'email'=>'required|email'
        ]);

        event(new InviteUser($request->email));

        return redirect()->back();
    }

    public function removeUser(User $user){

    }

    public function leaveTeam(Team $team){

    }
}
