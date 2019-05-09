<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['name','user_id','client_id','description','estimation','time_spent','status'];

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function getStatusForHumansAttribute(){
        // finished - Finished
        // in_progress = In progress
        // here_is_big_status
        return ucfirst(str_replace("_"," ", $this->status));
    }
}













