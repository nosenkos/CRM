<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    public function owner(User $user, Project $project){
        if($user->id == $project->user_id){
            return true;
        }
        return false;
    }
}
