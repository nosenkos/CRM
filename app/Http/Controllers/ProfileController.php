<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function edit(){
        return view('profile');
    }

    public function update(Request $request){

        $profile = auth()->user()->profile;

        $request->validate([
            'firstname'=>'required|string',
            'lastname'=>'required|string',
            'phone'=>'nullable|string',
            'address'=>'nullable|string',
            'gender'=>'required|in:not_defined,male,female,alien'
        ]);

        $profile->firstname = $request->firstname;
        $profile->lastname = $request->lastname;
        $profile->phone = $request->phone;
        $profile->address = $request->address;
        $profile->gender = $request->gender;
        if($request->profile_image){
            $profile->profile_image = $request->file('profile_image');
        }

        if($profile->save()){
            Session::flash('success',__('Profile updated'));
            return redirect()->back();
        }

    }
}
