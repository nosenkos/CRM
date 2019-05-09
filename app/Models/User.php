<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile(){
        return $this->hasOne(Profile::class);
    }

    public function projects(){
        return $this->hasMany(Project::class);
    }

    public function clients(){
        return $this->hasMany(Client::class);
    }

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function own_team(){
        return $this->hasOne(Team::class, 'owner_id','id');
    }

    public function teams(){
        return $this->belongsToMany(Team::class);
    }
}




























