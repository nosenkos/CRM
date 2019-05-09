<?php

namespace App\Http\Traits;

use App\Models\Invite;
use Illuminate\Support\Facades\Session;

trait Invitable {

    public function checkToken($view){
        $token = null;
        $email = null;
        if(request()->has('token')){
            $token = request('token');
            $invite = Invite::where('token','=',$token)->first();
            if($invite){
                $email = $invite->email;
            }else{
                Session::flash('danger',__('Not such token'));
            }
        }
        return view($view,[
            'email'=>$email,
            'token'=>$token
        ]);
    }

}

?>
