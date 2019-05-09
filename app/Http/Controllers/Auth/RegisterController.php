<?php

namespace App\Http\Controllers\Auth;

use App\Http\Traits\Invitable;
use App\Models\Invite;
use App\Models\Profile;
use App\Models\Team;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers, Invitable;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return $this->checkToken('auth.register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'token'=>['nullable','string'],
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        if($user){
            $profile = Profile::create([
               'user_id'=>$user->id,
               'firstname'=>$data['firstname'],
               'lastname'=>$data['lastname']
            ]);
            if($profile){
                $team = Team::create(['owner_id'=>$user->id]);
                if($team){
                    $user->teams()->attach($team->id);

                    if(isset($data['token']) && $data['token'] != NULL){
                        $invite = Invite::where('token','=',$data['token'])->first();
                        if($invite) {
                            if ($data['email'] == $invite->email) {
                                $team = Team::find($invite->team_id);
                                $team->users()->attach([$user->id]);
                                // TODO: Make this shit work properly. Now it duplicates this fuckers.
                                $invite->destroy($invite->id);
                            }
                        }
                    }

                    return $user;
                }

            }else{
                User::destroy($user->id);
            }
        }
    }
}















