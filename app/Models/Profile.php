<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use SahusoftCom\EloquentImageMutator\EloquentImageMutatorTrait;

class Profile extends Model
{
    use EloquentImageMutatorTrait;

    protected $image_fields = ['profile_image'];

    protected $fillable = ['firstname','lastname','phone','user_id','address','gender','profile_image'];

    public function getFullnameAttribute(){
        return $this->firstname . " " . $this->lastname;
    }
}
