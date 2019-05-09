<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['owner_id'];

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function owner(){
        return $this->belongsTo(User::class);
    }

    public function getTeamnameAttribute(){
        if($this->name){
            return $this->name;
        }
        return $this->owner->profile->fullname;
    }
}














